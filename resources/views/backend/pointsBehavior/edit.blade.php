<x-app-layout>



    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Points Rule</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.pointsBehavior.update',$pointsBehavior)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">subject</label>
                                    <select name="subject_id" class="form-control">
                                        <option value="null" disabled selected>Select subject...</option>
                                        @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}" {{$pointsBehavior->subject->id == $subject->id ? 'selected' :''}}>{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Point</label>
                                    <select name="point_id" class="form-control">
                                        <option value="null" disabled selected>Select point...</option>
                                        @foreach($points as $point)
                                            <option value="{{$point->id}}" {{$pointsBehavior->point->id == $point->id ? 'selected' :''}}>{{$point->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Rule</label>
                                    <select name="behavior_id" class="form-control">
                                        <option value="null" disabled selected>Select Rule...</option>
                                        @foreach($behaviors as $rule)
                                            <option value="{{$rule->id}}" {{$pointsBehavior->behavior->id == $rule->id ? 'selected' :''}}>{{$rule->name}}</option>
                                        @endforeach
                                    </select>
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
