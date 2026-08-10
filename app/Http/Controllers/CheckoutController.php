<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrintDocument;
use App\Models\Price;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {


        $selectedIds = session(
            'upload_selected_document_ids',
            []
        );



        if (empty($selectedIds)) {

            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'Please select at least one document.'
                );
        }



        $printOptions = session(
            'print_options',
            []
        );



        $documents = PrintDocument::whereIn(
            'id',
            $selectedIds
        )
            ->get([
                'id',
                'original_name',
                'file_size',
                'pages',
                'mime_type',
                'status'
            ]);




        $mobile = $request->cookie(
            'loggedin_number'
        );



        $printPrices = Price::whereIn(
            'slug',
            [
                'black_white_single',
                'black_white_double',
                'color_single',
                'color_double',
            ]
        )
            ->where(
                'status',
                1
            )
            ->pluck(
                'amount',
                'slug'
            );



        $binding = Price::where(
            'slug',
            'bindings'
        )
            ->where(
                'status',
                1
            )
            ->with([
                'childPrice' => function ($query) {

                    $query
                        ->where('status', 1)
                        ->orderBy('id');
                }
            ])
            ->first();



        $bindingPrices = [];


        if ($binding) {

            foreach (
                $binding->childPrice
                as $bindingOption
            ) {

                $bindingPrices[$bindingOption->slug] = (float) $bindingOption->amount;
            }
        }


        $printSubtotal = 0;

        $fileBreakdown = [];


        foreach ($documents as $document) {

            $documentId =
                (int) $document->id;


            $options =
                $printOptions[$documentId]
                ?? [];



            $colorMode =
                $options['color_mode']
                ?? 'black_white';


            $printSide =
                $options['print_side']
                ?? 'double';


            $bindingSlug =
                $options['binding']
                ?? '';


            $pageSize =
                $options['page_size']
                ?? 'a4_75';


            $orientation =
                $options['orientation']
                ?? 'portrait';


            $copies =
                max(
                    1,
                    (int) (
                        $options['copies']
                        ?? 1
                    )
                );


            $pages = max(
                1,
                (int) (
                    $document->pages
                    ?? 1
                )
            );



            if (
                $colorMode === 'color'
            ) {

                if (
                    $printSide === 'double'
                ) {

                    $rate =
                        (float) (
                            $printPrices['color_double'] ?? 0
                        );
                } else {

                    $rate =
                        (float) (
                            $printPrices['color_single'] ?? 0
                        );
                }
            } else {

                if (
                    $printSide === 'double'
                ) {

                    $rate =
                        (float) (
                            $printPrices['black_white_double'] ?? 0
                        );
                } else {

                    $rate =
                        (float) (
                            $printPrices['black_white_single'] ?? 0
                        );
                }
            }



            $billableSheets = $pages;




            $printCostPerCopy =
                $billableSheets *
                $rate;




            $bindingRate =
                0;


            if (
                !empty($bindingSlug)
            ) {

                $bindingRate =
                    (float) (
                        $bindingPrices[$bindingSlug] ?? 0
                    );
            }




            $oneCopyTotal =
                $printCostPerCopy +
                $bindingRate;



            $fileTotal =
                $oneCopyTotal *
                $copies;



            $printSubtotal +=
                $fileTotal;



            $fileBreakdown[] = [

                'id' =>
                $documentId,

                'name' =>
                $document->original_name,

                'pages' =>
                $pages,

                'color_mode' =>
                $colorMode,

                'print_side' =>
                $printSide,

                'binding' =>
                $bindingSlug,

                'page_size' =>
                $pageSize,

                'orientation' =>
                $orientation,

                'copies' =>
                $copies,

                'rate' =>
                $rate,

                'billable_sheets' =>
                $billableSheets,

                'print_cost_per_copy' =>
                round(
                    $printCostPerCopy,
                    2
                ),

                'binding_rate' =>
                $bindingRate,

                'total' =>
                round(
                    $fileTotal,
                    2
                ),
            ];
        }


        $handlingCharge = 0;




        $deliveryCharge = 0;


        $grandTotal =
            $printSubtotal +
            $handlingCharge +
            $deliveryCharge;


        return view(
            'front.checkout',
            compact(
                'documents',
                'mobile',
                'printSubtotal',
                'handlingCharge',
                'deliveryCharge',
                'grandTotal',
                'fileBreakdown'
            )
        );
    }
}
