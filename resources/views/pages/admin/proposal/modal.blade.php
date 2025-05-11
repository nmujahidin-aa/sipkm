<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Ketua Tim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.proposal.update-leader', $proposal->id) }}">
            @csrf
                <div class="modal-body">
                    <input type="hidden" name="proposal_id" value="{{$proposal->id}}">
                    <p>Ketua tim hanya dapat diganti oleh anggota saat ini.</p>
                    <div class="form-group">
                        <label for="newLeader">Pilih Ketua Baru</label>
                        <select class="form-control" id="newLeader" name="new_leader_id">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($proposal->members as $row)
                                <option value="{{$row->user_id}}">{{$row->user->name}} ({{$row->user->nim}})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>