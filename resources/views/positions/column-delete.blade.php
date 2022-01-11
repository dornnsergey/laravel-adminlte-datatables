<a href='' data-toggle="modal" data-target="#delete{{$position->id}}">
        <i class='pr-3 text-dark fas fa-trash-alt'></i>
</a>

<!-- Modal -->
<div class="modal fade" id="delete{{ $position->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to remove position {{ $position->name }}?
            </div>
            <form action="{{ route('positions.destroy', $position) }}" method="POST">
            <div class="modal-footer">
                    @method('DELETE')
                    <input type="hidden" name="_token" value="{{ $token }}">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Remove</button>
            </div>
            </form>
        </div>
    </div>
</div>
