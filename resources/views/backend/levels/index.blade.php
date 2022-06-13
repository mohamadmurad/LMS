<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>level </h6>
                    <a href="{{route('backend.levels.create')}}" @class('btn btn-success')>Create New Level</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>

                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($levels as $level)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">

                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$level->name}}</h6>
                                                @if($level->hasMedia('icon'))
                                                    <p class="text-xs text-secondary mb-0">
                                                        <img width="20" height="20" src="{{$level->getFirstMediaUrl('icon')}}">

                                                    </p>
                                                @endif


                                            </div>
                                        </div>
                                    </td>


                                    <td class="align-middle">

                                        <form action="{{route('backend.levels.destroy',$level)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                               href="{{route('backend.levels.edit',$level)}}"><i
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
