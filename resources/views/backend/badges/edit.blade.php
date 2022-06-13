<x-app-layout>


    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit badges</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.badges.update',$badge)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$badge->name}}"
                                    >
                                </div>
                            </div>
                            @if($badge->hasMedia('icon'))
                                <div class="card card-profile mw-50">
                                    <img class="Image w-50 edit-image" src="{{$badge->getFirstMediaUrl('icon')}}"
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
                                <button type="submit" @class('btn btn-success') >Update</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
