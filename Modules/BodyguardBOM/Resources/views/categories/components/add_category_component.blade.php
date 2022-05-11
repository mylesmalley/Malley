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
            <label for="name">Category Name</label>
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   required>
            <input type="submit" value="Save">
        </form>
    </div>

</div>