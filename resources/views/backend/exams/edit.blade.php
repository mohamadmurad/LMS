<x-app-layout>


    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create Question</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.questions.update',['subject'=>$subject,'question'=>$question])}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">question</label>
                                    <input class="form-control" type="text" name="question" value="{{$question->question}}" required
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Objective</label>
                                    <select name="objective_id" class="form-control" required>
                                        @foreach($modules as $module)
                                            <optgroup label="{{$module->name}}">
                                                @foreach($module->objectives as $obj)
                                                    <option value="{{$obj->id}}" {{$question->objective_id == $obj->id ? 'selected' : '' }}>{{$obj->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($question->hasMedia('q_files'))

                                <div class="">
                                    <a class="" target="_blank" href="{{$question->getFirstMediaUrl('q_files')}}"><i class="fa fa-file me-2"></i>View</a>
                                </div>
                            @endif
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">File (optional)</label>
                                    <input class="form-control" type="file"
                                           name="file" value="{{old('file')}}" autocomplete="subject" >
                                </div>
                            </div>
                            <hr>
                            <div class="options">
                                @foreach($question->options as $index => $option)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="radio" name="option_correct" value="{{$index+1}}" id="option_{{$index+1}}_correct"
                                                       required {{$option->correct? 'checked':''}}>
                                                <label class="form-check-label" for="option_{{$index+1}}_correct" >Correct?</label>
                                            </div>

                                        </div>
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input class="form-control" type="text"
                                                       name="option_{{$index+1}}" value="{{$option->option}}" autocomplete="subject" placeholder="Option 1" required>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                            <div class="col-md-6">
                                <button type="submit" @class('btn btn-success') >Edit</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
