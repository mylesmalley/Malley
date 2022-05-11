<div class="card border-danger">
    <div class="card-header bg-danger text-white">
        <h5>Delete Category</h2>
    </div>
    <div class="card-body">
        <p>This cateogry has no children so can be deleted.</p>
        <form action="{{ route('bg.categories.delete') }}" method="POST">
            @csrf
            @method("DELETE")
            <input type="hidden"
                   name="id"
                   id="id"
                   value="{{ $category->id }}">

            <input type="hidden"
                   name="parent_id"
                   id="parent_id"
                   value="{{ $category->parent_id }}">

            <input type="submit" value="Delete">
        </form>
    </div>
</div>
