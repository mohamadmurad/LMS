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
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{$objective->name}}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Edit Objective</h6>
        </nav>
    @endsection

    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit objective</p>


                    </div>
                    <span class="text-sm">Subject: <a
                            href="{{route('backend.subjects.show',$subject)}}">{{$subject->name}}</a></span>
                    <br>
                    <span class="text-sm">Module: <a href="">{{$module->name}}</a></span>
                    <br>
                    <span class="text-sm">Objective : <a href="">{{$objective->name}}</a></span>

                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post"
                          action="{{route('backend.objectives.update',['subject' => $subject,'module' => $module,'objective' => $objective ])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Objective Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$objective->name}}"
                                    >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Objective Complete
                                        Points</label>
                                    <input class="form-control" type="number" name="process_points"
                                           value="{{$objective->points->count?? ''}}"
                                    >
                                    <span class="text-xs">points collect if student complete this objective</span>
                                </div>
                            </div>
                            <div class="col-md-12" id="vid">
                                @if( $objective->getFirstMediaUrl('videos'))
                                    <div @class('text-center')>
                                        <video class="w-75" src="{{$objective->getFirstMediaUrl('videos')}}" controls>

                                        </video>
                                    </div>

                                @endif
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Video (Optional)</label>
                                    <input class="form-control" type="file" accept="video/*" name="video">

                                </div>

                            </div>

                            <div class="col-md-12" id="letter"
                                 style="display: {{$objective->type ==1 ? 'none':'block'}}">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Content</label>
                                    <textarea name="content"
                                              class="editor form-control">{{$objective->content}}</textarea>
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
