<div class="card border-secondary">
    <div class="card-header bg-secondary text-white">
        <h5>Add Sub Category</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('bg.categories.store') }}" method="POST">
            @csrf
            <input type="hidden"
                   name="parent_id"
                   id="parent_id"
                   value="{{ $category->id }}">

            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="ro">
                <div class="col-12">
                    <label for="name">Category Name</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required>
                    <input type="submit" value="Save">
                </div>
            </div>
            <div class="ro">
                <div class="col-6">
                    <label for="name">Type</label>
                    <input type="text"
                           class="form-control"
                           id="type"
                           name="type"
                           value="{{ old('type') }}"
                           required>
                </div>
                <div class="col-6">
                    <label for="name">Code</label>
                    <input type="text"
                           class="form-control"
                           id="code"
                           name="code"
                           value="{{ old('code') }}"
                           required>
                </div>
            </div>
        </form>
    </div>

</div>