<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProposalReview;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Enums\RoleEnum;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\ProposalRequest;
use App\Http\Requests\User\ProposalReviewRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Setting;
class ProposalController extends Controller
{
    use AuthorizesRequests;
    private $view;
    private $route;
    private $proposal;
    private $member;
    private $user;
    private $proposalReview;
    private $setting;
    public function __construct()
    {
        $this->view = "pages.user.proposal.";
        $this->route = "proposal.";
        $this->proposal = new Proposal();
        $this->member = new Member();
        $this->user = new User();
        $this->proposalReview = new ProposalReview();
        $this->setting = new Setting();
    }

    public function index()
    {
        $member = $this->member::where('user_id', Auth::user()->id)->get();
        $proposal = $this->proposal::with('user')->whereIn('id', $member->pluck('proposal_id'))->paginate(10);
        $advisor = $this->member::whereIn('proposal_id', $proposal->pluck('id')->all())
            ->where('role_in_team', 'advisor')
            ->get()
            ->groupBy('proposal_id');

        // Cari di model member dimana semua yang mempunyai proposal_id sama dengan $proposal->id dan value dari role_in_team = member
        $proposal_member = $this->member::whereIn('proposal_id', $proposal->pluck('id')->all())
            ->where('role_in_team', 'member')
            ->get()
            ->groupBy('proposal_id');

        // Cari proposal review by proposal_id
        $proposalReview = $this->proposalReview::whereIn('proposal_id', $proposal->pluck('id')->all())
            ->where('status', false)
            ->get()
            ->groupBy('proposal_id');

        $setting = $this->setting::first();

        return view($this->view . "index",[
            'proposal' => $proposal,
            'proposal_member' => $proposal_member,
            'advisor' => $advisor,
            'proposalReview' => $proposalReview,
            'setting' => $setting
        ]);
    }

    public function edit(string $id = null){
        $proposal = null;
        if ($id) {
            $proposal = $this->proposal::findOrFail($id);
            $this->authorize('update', $proposal);
        }
        $members = $this->user->role(RoleEnum::MAHASISWA)->get();
        $advisors = $this->user->role(RoleEnum::DOSEN)->get();
        $scheme = ['KI', 'KC', 'K', 'RE', 'RSH', 'PM', 'PI', 'VGK', 'GFT', 'AI'];

        // Mengambil semua data review proposal berdasarkan id proposal
        $proposalReview = $this->proposalReview::where('proposal_id', $id)->get();

        return view($this->view."edit",[
            'proposal' => $proposal,
            'members' => $members,
            'advisors' => $advisors,
            'scheme' => $scheme,
            'proposalReview' => $proposalReview
        ]);
    }

    public function store(ProposalRequest $request)
    {
        // Cek apakah ini proses create atau update
        $isCreate = !$request->has('id');

        // Jika ini proses create, cek apakah proposal submission dibuka
        if ($isCreate) {
            $setting = Setting::first(); // Ambil setting (asumsi setting disimpan di tabel settings)
            if (!$setting || !$setting->is_proposal_submission_open) {
                alert()->html('Gagal', 'Proses pengajuan proposal ditutup. Silakan hubungi PKM CENTER.', 'error');
                return redirect()->back()->withInput();
            }
        }

        $validatedData = $request->validated();

        // Jika ini proses create, ambil tahun pengajuan dari setting
        if ($isCreate) {
            $setting = Setting::first();
            $validatedData['year'] = $setting->proposal_submission_year;
        }

        // Jika ini proses edit, ambil proposal yang sudah ada
        $proposal = $request->has('id') ? $this->proposal::findOrFail($request->id) : null;

        // Upload file jika ada file baru yang diunggah
        if ($request->hasFile('file')) { 
            $user = User::findOrFail($request->leader_id);
            $name = preg_replace('/\s+/', '', $user->name);
            $fileName = $name . '_UniversitasNegeriMalang_' . $request->scheme . '.' . $request->file->getClientOriginalExtension();
            $validatedData['file'] = $request->file->storeAs('proposal', $fileName, 'public');
        } elseif ($proposal && $proposal->file) {
            // Jika tidak ada file baru, pertahankan file lama
            $validatedData['file'] = $proposal->file;
        }

        $validatedData['faculty_id'] = User::findOrFail($request->leader_id)->faculty_id;

        // Simpan atau update proposal
        $proposal = $this->proposal::updateOrCreate(['id' => $request->id], $validatedData);
        $proposal->proposalMembers()->delete();

        $roles = [
            'advisor' => $request->advisors,
            'leader' => $request->leader_id,
            'member' => $request->members,
        ];

        foreach ($roles as $role => $users) {
            if ($users) {
                $users = is_array($users) ? $users : [$users];
                foreach ($users as $userId) {
                    $proposal->proposalMembers()->create([
                        'proposal_id' => $proposal->id,
                        'user_id' => $userId,
                        'role_in_team' => $role,
                    ]);
                }
            }
        }

        alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
        return redirect()->route($this->route . 'index')->with('success', 'Proposal berhasil disimpan!');
    }

    public function single_destroy($id)
    {
        $proposal = $this->proposal::findOrFail($id);
        $proposal->proposalMembers()->delete();
        $proposal->delete();

        alert()->html('Berhasil', 'Data berhasil dihapus', 'success');
        return redirect()->route($this->route . 'index')->with('success', 'Proposal berhasil dihapus!');
    }

    public function review(string $proposal_id, string $id = null)
    {
        $proposalReview = null;
        $proposal = $this->proposal::findOrFail($proposal_id);
        if ($id) {
            $proposalReview = $this->proposalReview::findOrFail($id);
        }
        return view($this->view . "review", [
            'proposal_id' => $proposal_id,
            'proposal' => $proposal,
            'proposalReview' => $proposalReview
        ]);
    }

    public function storeReview(string $proposal_id, ProposalReviewRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['proposal_id'] = $proposal_id;
        $validatedData['status'] = 1;

        if ($request->has('id')) {
            $proposalReview = $this->proposalReview::findOrFail($request->id);
            $proposalReview->update($validatedData);
            alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
            return redirect()->route($this->route . 'edit', ['id' => $proposal_id]);
        } else {
            $proposalReview = $this->proposalReview::create($validatedData);
            alert()->html('Berhasil', 'Data berhasil disimpan', 'success');
            return redirect()->route($this->route . 'edit', ['id' => $proposal_id]);
        }
    }
}
