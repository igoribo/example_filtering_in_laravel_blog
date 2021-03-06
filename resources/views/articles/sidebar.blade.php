<form action="{{ route('articles.index') }}" method="GET">
<div class="card">
    <div class="card-header">Search by keyword</div>

    <div class="card-body">
        <input type="text" name="query" placeholder="Enter a keyword here..." value="{{ request('query') }}" />
        <input type="submit" class="btn btn-sm btn-info" value="Search" />
    </div>
</div>

<br />

<div class="card">
    <div class="card-header">Categories</div>

    <div class="card-body">
        <ul>
            @foreach ($all_categories as $category)
                <li>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" /> {{ $category->name }}
                </li>
            @endforeach
        </ul>
    </div>
</div>

<br />

<div class="card">
    <div class="card-header">Tags</div>

    <div class="card-body">
        <ul>
            @foreach ($all_tags as $tag)
                <li>
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" /> {{ $tag->name }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
</form>
