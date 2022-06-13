<x-app-layout>


    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Rule</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.behaviors.update',$behavior)}}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$behavior->name}}"
                                    >
                                </div>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="example-text-input" class="form-control-label">Notification--}}
{{--                                        Title</label>--}}
{{--                                    <input class="form-control" type="text" name="notification_title"--}}
{{--                                           value="{{$rule->notification_title}}"--}}
{{--                                    >--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="example-text-input" class="form-control-label">Notification Body</label>--}}
{{--                                    <textarea class="form-control"--}}
{{--                                              name="notification_body">{{$rule->notification_body}}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="col-md-6">
                                <button type="submit" @class('btn btn-success') >Update</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
