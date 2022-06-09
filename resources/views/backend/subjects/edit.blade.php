<x-app-layout>
    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.subjects.index')}}">Subjects</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Edit {{$subject->name}}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{$subject->name}}</h6>
        </nav>
    @endsection


    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Subject</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.subjects.update',$subject)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Category</label>

                                    <select class="form-select form-control" name="category_id" required>
                                        <option value="null" disabled>Select...</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{$category->id ==$subject->category->id ? 'selected': '' }}>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$subject->name}}"
                                    >
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Enroll Points</label>
                                    <input class="form-control" type="number" name="process_points"
                                           value="{{$subject->points->count ?? ''}}"
                                    >
                                    <span class="text-xs">points collect if student Enroll this subject</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">description</label>
                                    <textarea
                                        @class('form-control editor') name="description">{{$subject->description}}</textarea>
                                </div>
                            </div>
                            {{--                            @if(\Illuminate\Support\Facades\File::exists('sub_cover_img/'.$subject->cover))--}}




                            {{--                            @endif--}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Cover Image</label>

                                    <input class="form-control" type="file" name="cover" accept="image/*"
                                    >
                                    <img class="edit-image" src="{{$subject->getFirstMediaUrl('cover')}}"
                                         alt="cover"/>
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
