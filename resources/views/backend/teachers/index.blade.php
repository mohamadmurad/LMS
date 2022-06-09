<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Teachers </h6>
                    <a href="{{route('backend.teachers.create')}}" @class('btn btn-success')>Create New teachers</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">

                                            <div>
                                                <a href="{{$user->getFirstMediaUrl('certificate')}}" class="fancy"
                                                   data-fancybox="group" data-caption="{{$user->name}}"><img
                                                        class="avatar avatar-sm me-3 fancy"
                                                        src="{{$user->getFirstMediaUrl('certificate')}}"
                                                        alt="cert_imgage"/></a>
                                            </div>


                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">{{$user->name}}</p>
                                                <h6 class="text-sm mb-0">{{$user->email}}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$user->is_verified ? 'Verified' : 'Not Verified'}}</p>
                                        <p class="text-xs text-secondary mb-0">{{$user->birthDate ?? 'N/A'}}</p>
                                    </td>

                                    <td class="align-middle">

                                        <form action="{{route('backend.teachers.destroy',$user)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                               href="{{route('backend.teachers.edit',$user)}}"><i
                                                    class="fa fa-pencil me-2"></i> edit </a>
                                            <a type="submit" class="text-danger font-weight-bold text-xs btn btn-link"
                                               onclick="delete_submit(this)"><i class="fa fa-trash me-2"></i> Delete</a>
                                            @if(!$user->is_verified)
                                                <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                                   href="{{route('backend.teachers.verify',$user)}}"><i
                                                        class="fa fa-unlock me-2"></i> verify </a>
                                            @endif

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


