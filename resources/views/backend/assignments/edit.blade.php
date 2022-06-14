<x-app-layout>



    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Update assignment</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.assignments.update',['subject'=>$subject,'assignment'=>$assignment])}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" name="name" value="{{$assignment->name}}"
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Module</label>
                                    <select name="module_id" class="form-control">
                                        @foreach($modules as $module)
                                            <option value="{{$module->id}}" {{$assignment->module->id == $module->id ? 'selected' :''}}>{{$module->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($assignment->hasMedia('file'))

                                <div class="">
                                    <a class="" target="_blank" href="{{$assignment->getFirstMediaUrl('file')}}"><i class="fa fa-file me-2"></i>View</a>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">File (optional)</label>
                                    <input class="form-control" type="file"
                                           name="file" value="{{old('file')}}" autocomplete="subject">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">description</label>
                                    <textarea @class('form-control editor') name="description">{{$assignment->description}}</textarea>
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
