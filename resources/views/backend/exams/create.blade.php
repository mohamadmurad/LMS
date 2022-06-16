<x-app-layout>


    <div @class('row')>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Create Question</p>

                    </div>
                </div>
                <div class="card-body">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    <form method="post" action="{{route('backend.exams.store',$subject)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <livewire:create-exam-form :subject="$subject" />

                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
