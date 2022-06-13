<x-app-layout>


    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create behavior</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.behaviors.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}"
                                    >
                                </div>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="example-text-input" class="form-control-label">Notification--}}
{{--                                        Title</label>--}}
{{--                                    <input class="form-control" type="text" name="notification_title"--}}
{{--                                           value="{{old('notification_title')}}"--}}
{{--                                    >--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="example-text-input" class="form-control-label">Notification Body</label>--}}
{{--                                    <textarea class="form-control"--}}
{{--                                              name="notification_body">{{old('notification_body')}}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="col-md-6">
                                <button type="submit" @class('btn btn-success') >create</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
