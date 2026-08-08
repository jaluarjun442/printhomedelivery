@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Store</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.save_store') }}" id="add_form" name="add_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Website</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="Website">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Website Url</label>
                                <input type="text" class="form-control" id="website_url" name="website_url" placeholder="Website Url">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Tag</label>
                                <input type="text" class="form-control" id="tag_id" name="tag_id" placeholder="Tag">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Pan</label>
                                <input type="text" class="form-control" id="pan_card" name="pan_card" placeholder="Pan">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Payment</label>
                                <input type="text" class="form-control" id="payment" name="payment" placeholder="Payment">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="inactive">InActive</option>
                                    <option value="active">Active</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">About Us Tag</label>
                                <input type="text" class="form-control" id="about_us_tag" name="about_us_tag" placeholder="Tag">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Redirect Timing (Second)</label>
                                <input type="text" class="form-control" value="0" id="red_tim" name="red_tim" placeholder="Second">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Header Script</label>
                                <textarea class="form-control" id="header_script" name="header_script"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Sidebar Script</label>
                                <textarea class="form-control" id="sidebar_script" name="sidebar_script"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Footer Script</label>
                                <textarea class="form-control" id="footer_script" name="footer_script"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#add_form").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                }
            }
        });
    });
</script>
@endsection