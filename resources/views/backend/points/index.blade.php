
<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Points </h6>
                    <a href="{{route('backend.points.create')}}" @class('btn btn-success')>Create New Point</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Points Count</th>

                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($points as $point)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">

                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$point->name}}</h6>


                                                @if($point->hasMedia('icon'))
                                                    <p class="text-xs text-secondary mb-0">
                                                        <img width="20" height="20"
                                                             src="{{$point->getFirstMediaUrl('icon')}}">

                                                    </p>
                                                @endif


                                            </div>

                                        </div>
                                    </td>


                                    <td>

                                            <h6 >{{$point->count}}</h6>




                                    </td>
                                    <td class="align-middle">

                                        <form action="{{route('backend.points.destroy',$point)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                               href="{{route('backend.points.edit',$point)}}"><i
                                                    class="fa fa-pencil me-2"></i> edit </a>
                                            <a type="submit" class="text-danger font-weight-bold text-xs btn btn-link"
                                               onclick="delete_submit(this)"><i class="fa fa-trash me-2"></i>Delete</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
