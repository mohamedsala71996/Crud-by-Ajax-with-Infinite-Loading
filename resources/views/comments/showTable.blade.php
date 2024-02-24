@forelse ($comments as $comment)
<tr>
    <td class="align-middle text-center">{{ $comment->name }}</td>
    <td class="align-middle text-center">{{ $comment->comment }}</td>
    <td class="align-middle text-center">
        <a href="#" class="btn btn-sm btn-primary mr-1 edit" data-id="{{ $comment->id }}"
            data-name="{{ $comment->name }}" data-comment="{{ $comment->comment }}">Edit</a>
        <a href="#" class="btn btn-sm btn-danger delete" data-id="{{ $comment->id }}">Delete</a>
    </td>
</tr>
@empty
<tr>
    <td colspan="3" class="text-center">No comments found.</td>
</tr>
@endforelse
<div class="d-none">
    {{ $comments->links('pagination::bootstrap-5') }}
</div>