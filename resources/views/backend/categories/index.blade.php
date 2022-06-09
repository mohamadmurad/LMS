<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Categories </h6>
                    <a href="{{route('backend.categories.create')}}" @class('btn btn-success')>Create New Category</a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject
                                    Count
                                </th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($categories as $cat)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">

                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$cat->title}}</h6>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">

                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{$cat->subjects_count}}</h6>

                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle">

                                    <form action="{{route('backend.categories.destroy',$cat)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a class="text-secondary font-weight-bold text-xs btn btn-link"
                                           href="{{route('backend.categories.edit',$cat)}}"><i
                                                class="fa fa-pencil me-2"></i> edit </a>
                                        <a type="submit" class="text-danger font-weight-bold text-xs btn btn-link"
                                           onclick="delete_submit(this)"><i class="fa fa-trash me-2"></i>Delete</a>
                                    </form>
                                </td>
                            </tr>
                            @empty

                                <tr><td>No Data</td></tr>
                            @endforelse

                            </tbody>
                        </table>
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
