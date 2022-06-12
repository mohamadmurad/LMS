<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.subjects.index')}}">Subjects</a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.subjects.show',$subject)}}">{{$subject->name}}</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{$module->name}}</li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Create Objective</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">New Objective</h6>
        </nav>
    @endsection

    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create objective</p>


                    </div>
                    <span class="text-sm">Subject: <a
                            href="{{route('backend.subjects.show',$subject)}}">{{$subject->name}}</a></span>
                    <br>
                    <span class="text-sm">Module: <a href="">{{$module->name}}</a></span>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.objectives.store',['subject' => $subject,'module' => $module,])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
{{--                            <div class="col-md-12">--}}
{{--                                <div class="form-check form-switch">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="type" id="typeId">--}}
{{--                                    <label class="form-check-label" for="rememberMe" >Is Video</label>--}}
{{--                                </div>--}}

{{--                            </div>--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Objective Name</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}"
                                    >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Objective Complete Points</label>
                                    <input class="form-control" type="number" name="process_points" value="{{old('process_points')}}"
                                    >
                                    <span class="text-xs">points collect if student complete this objective</span>
                                </div>
                            </div>
                            <div class="col-md-12" id="vid" >
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Video (Optional)</label>
                                    <input class="form-control" type="file" accept="video/*" name="video"
                                    >

                                </div>
                            </div>

                            <div class="col-md-12" id="letter">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Content</label>
                                    <textarea name="content" class="editor form-control">{{old('content')}}</textarea>
                                </div>
                            </div>


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

