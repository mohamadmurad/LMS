<x-app-layout>


    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create Point</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('teacher.behaviorPoints.update',$behaviorPoint)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name"
                                           value="{{$behaviorPoint->name}}"
                                    >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Point Count</label>
                                    <input class="form-control" type="number" name="count"
                                           value="{{$behaviorPoint->count}}"
                                    >
                                </div>
                            </div>
                            @if($behaviorPoint->icon && \Illuminate\Support\Facades\File::exists('points_icon/'.$behaviorPoint->icon))
                                <div class="card card-profile mw-50">
                                    <img class="Image w-50" src="{{asset('points_icon/'.$behaviorPoint->icon)}}"
                                         alt="cert_imgage"/>
                                </div>

                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Icon</label>
                                    <input class="form-control" type="file"
                                           name="icon" value="{{old('icon')}}" autocomplete="subject">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" @class('btn btn-success') >update</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
