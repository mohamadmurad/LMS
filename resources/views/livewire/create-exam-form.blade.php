<div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Exam Name</label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Question Count</label>
               <input class="form-control" type="number" min="1" max="{{$max}}" name="count" wire:model="count" placeholder="Questions count">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Level</label>
                <select name="level" class="form-control" wire:model="level" required>
                    <option value="0">Easy</option>
                    <option value="1">medium</option>
                    <option value="2">Hard</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Module</label>

                <select name="module_id" wire:model="x" class="form-control" required>
                    @foreach($modules as $module)

                        <option value="{{$module->id}}">{{$module->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Exam Points success</label>
                <input class="form-control" type="number" name="exam_points" value="{{old('exam_points')}}" required>
                <small>Collected if has 60% or higher</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Exam Points fail</label>
                <input class="form-control" type="number" name="exam_points_fail" value="{{old('exam_points_fail')}}"
                       required>
                <small>Collected if has 60% or lower</small>
            </div>
        </div>
        <hr>
{{--        <div class="questions">--}}
{{--            @foreach($questions as $question)--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-1">--}}
{{--                        <div class="form-check form-switch">--}}
{{--                            <input class="form-check-input" type="checkbox" name="question[{{$question->id}}]"--}}
{{--                                   id="option_{{$question->id}}_correct">--}}
{{--                            <label class="form-check-label" for="option_{{$question->id}}_correct"></label>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="col-md-10">--}}
{{--                        <p>{{$question->question}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            @endforeach--}}
{{--        </div>--}}

        <div class="col-md-6">
            <button type="submit" @class('btn btn-success') >Add</button>
        </div>
    </div>
</div>
