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
                    <form method="post" action="{{route('backend.questions.store',$subject)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">question</label>
                                    <input class="form-control" type="text" name="question" value="{{old('question')}}" required
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
                                                    <option value="{{$obj->id}}">{{$obj->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">File (optional)</label>
                                    <input class="form-control" type="file"
                                           name="file" value="{{old('file')}}" autocomplete="subject" >
                                </div>
                            </div>
                            <hr>
                            <div class="options">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" name="option_correct" value="1" id="option_1_correct" required>
                                            <label class="form-check-label" for="option_1_correct" >Correct?</label>
                                        </div>

                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input class="form-control" type="text"
                                                   name="option_1" value="{{old('option_1')}}" autocomplete="subject" placeholder="Option 1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" name="option_correct" value="2" id="option_2_correct" required>
                                            <label class="form-check-label" for="option_2_correct" >Correct?</label>
                                        </div>

                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input class="form-control" type="text"
                                                   name="option_2" value="{{old('option_2')}}" autocomplete="subject" placeholder="Option 2" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" name="option_correct" value="3" id="option_3_correct" required>
                                            <label class="form-check-label" for="option_3_correct" >Correct?</label>
                                        </div>

                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input class="form-control" type="text"
                                                   name="option_3" value="{{old('option_3')}}" autocomplete="subject" placeholder="Option 3" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" name="option_correct" value="4" id="option_4_correct" required>
                                            <label class="form-check-label" for="option_4_correct" >Correct?</label>
                                        </div>

                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <input class="form-control" type="text"
                                                   name="option_4" value="{{old('option_4')}}" autocomplete="subject" placeholder="Option 4" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" @class('btn btn-success') >Add</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
