<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Students </h6>
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Admin'))
                        <a href="{{route('backend.students.create')}}" @class('btn btn-success')>Create New students</a>
                    @endif

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    info
                                </th>

                                <th class="text-secondary opacity-7"></th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">

                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                                                <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Student</p>
                                        <p class="text-xs text-secondary mb-0">{{$user->birthDate ?? 'N/A'}}</p>
                                    </td>
                                    <td class="align-middle">
                                        <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                           href="{{route('backend.students.show',$user)}}"><i
                                                class="fa fa-eye me-2"></i> Info </a>
                                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Admin'))


                                            <form action="{{route('backend.students.destroy',$user)}}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                                <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                                   href="{{route('backend.students.edit',$user)}}"><i
                                                        class="fa fa-pencil me-2"></i> edit </a>
                                                <a type="submit"
                                                   class="text-danger font-weight-bold text-xs btn btn-link"
                                                   onclick="delete_submit(this)"><i class="fa fa-trash me-2"></i>Delete</a>
                                            </form>

                                        @endif
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
