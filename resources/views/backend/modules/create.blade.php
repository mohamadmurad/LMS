<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('backend.subjects.index')}}">Subjects</a></li>
                <li class="breadcrumb-item text-sm" ><a class="opacity-5 text-white" href="{{route('backend.subjects.show',$subject)}}">{{$subject->name}}</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Create Module</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">New Module</h6>
        </nav>
    @endsection

    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create Module</p>


                    </div>

                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.modules.store',$subject)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}"
                                    >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Description</label>
                                    <textarea name="description" class="form-control editor">{{old('description')}}</textarea>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <button type="submit" @class('btn btn-success') >Create</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
