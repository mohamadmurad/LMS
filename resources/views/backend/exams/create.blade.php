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
                    <form method="post" action="{{route('backend.exams.store',$subject)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Exam Name</label>
                                    <input class="form-control" type="text" name="name" value="{{old('name')}}" required
                                    >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Module</label>
                                    <select name="module_id" class="form-control" required>
                                        @foreach($modules as $module)

                                            <option value="{{$module->id}}">{{$module->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <hr>
                            <div class="questions">
                                @foreach($questions as $question)
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="question[{{$question->id}}]"
                                                       id="option_{{$question->id}}_correct" >
                                                <label class="form-check-label" for="option_{{$question->id}}_correct"></label>
                                            </div>

                                        </div>
                                        <div class="col-md-10">
                                           <p>{{$question->question}}</p>
                                        </div>
                                    </div>

                                @endforeach
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
