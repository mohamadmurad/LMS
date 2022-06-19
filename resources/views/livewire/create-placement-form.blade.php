<div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Placement Name</label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}" required
                >
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Subject</label>
                <select name="subject_id" wire:model="x" class="form-control" required>
                    @foreach($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Placement Points</label>
                <input class="form-control" type="number" name="points" value="{{old('points')}}" required>

            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Placement Badge</label>
                <select name="badge_id" class="form-control" >
                    <option value="">Select..</option>
                    @foreach($badges as $badge)
                        <option value="{{$badge->id}}">{{$badge->name}}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <hr>
        <div class="questions">
            @foreach($modules as $module)
                <h3>{{$module->name}}</h3>
                @foreach($module->objectives as $objective)
                    <h5 class="ms-2">{{$objective->name}}</h5>
                    @foreach($objective->questions as $question)
                        <div class="row ms-4">
                            <div class="col-md-1">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="question[{{$question->id}}]"
                                           id="option_{{$question->id}}_correct">
                                    <label class="form-check-label" for="option_{{$question->id}}_correct"></label>
                                </div>

                            </div>
                            <div class="col-md-10">
                                <p>{{$question->question}}</p>
                            </div>
                        </div>
                    @endforeach
                @endforeach


            @endforeach
        </div>

        <div class="col-md-6">
            <button type="submit" @class('btn btn-success') >Add</button>
        </div>
    </div>
</div>
