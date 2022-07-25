<x-app-layout>

    @section('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.dashboard.index')}}">Dashboard</a></li>
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                                       href="{{route('backend.subjects.show',$subject)}}">{{$subject->name}}</a>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">Students</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">Students</h6>
        </nav>
    @endsection

    <div class="row mt-2">
        <div class="card mb-4">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Points</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Level</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->name}}</td>
                                <td>{{$student->rewardPointsSubject($subject->id)->withSum('point','count')->get()->sum('point_sum_count')}}</td>
                                <td>{{$student->level_name}}</td>

                                <td>
                                    <a class="btn btn-link"
                                       href="{{route('backend.subjects.student.info',['subject'=>$subject,'student'=>$student])}}">Info</a>
                                    <button type="button" class="btn btn-link btn-sm  req-btn"
                                            data-bs-toggle="modal" data-bs-target="#reqModal"
                                            data-student="{{$student->id}}"
                                            data-subject="{{$subject->id}}">Add Behavior
                                    </button>


                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title card-title " id="exampleModalLabel"><i class="fas fa-clipboard-list"></i>
                        Add Behavior</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="cont">
                    <form action="{{route('backend.studentBehavior.store')}}" method="post">

                        @csrf
                        <div class="inputs" id="inputs">

                        </div>
                        <div class="form-group">
                            <select name="rule_id" class="form-control">
                                @foreach($behaviors as $rule)
                                    <option value="{{$rule->id}}">{{$rule->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <button class="btn btn-primary" type="submit">Add</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $('#reqModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var student = button.data('student');
                var subject = button.data('subject');

                var html = "";


                html += '<input type="hidden" name="student_id" value="' + student + '">' +
                    '<input type="hidden" name="subject_id" value="' + subject + '">';

                $('#inputs').html(html);
            });
        </script>
    @endsection
</x-app-layout>
