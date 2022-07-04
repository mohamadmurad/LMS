<x-front-layout>

    @include('frontend.headSection',$subject)
    <div class="container mt-5">
        <div class="AuthPoints">
            <hr>
            <h3>Your Points in <a href="{{route('student.subject.learn',$subject)}}">{{$subject->name}}</a></h3>
            <p>Total : {{$totalPoints}}</p>
            <table class="table">
                <thead>
                <tr>
                    <th>Point Reason</th>
                    <th>Point Type</th>
                    <th>Count</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($authPoints as $point)
                    <tr>
                        <td>{{$point->point->reason->name}}</td>
                        <td>{{$point->point->behavior[0]->human_name}}</td>
                        <td>{{$point->point->count}}</td>
                        <td>{{$point->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-front-layout>
