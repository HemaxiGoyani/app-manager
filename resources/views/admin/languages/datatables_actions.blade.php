<div class="btn-group d-flex justify-content-center">
    <div class="btn-group dropleft datatables_action" role="group">
        <button type="button" class="btn btn-lg action-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
        </button>
        <div class="dropdown-menu">
            <a href="{{ route('admin.languages.show', $uuid) }}" class='dropdown-item py-2'>
                <i class="fas fa-eye"></i>&nbsp;&nbsp;View
            </a>
            <a href="{{ route('admin.languages.edit', $uuid) }}" class='dropdown-item py-2'>
                <i class="fas fa-edit"></i>&nbsp;&nbsp;Edit
            </a>
            <a class='dropdown-item py-2 bg-danger' href="javascript:void(0);" style="color: white; padding-bottom: 10px" onclick="ajaxCallDelete('{{ route('admin.languages.destroy', $uuid) }}',
                'Are you sure?', 'language-index')">
                <i class="fas fa-trash-alt mr-1"></i>&nbsp;&nbsp;Delete
            </a>
        </div>
    </div>
</div>
