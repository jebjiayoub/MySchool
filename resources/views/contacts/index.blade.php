@extends('layouts.app')

@section('content')

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

    @if(session()->has('success'))
       
      <div class="w3-panel w3-green w3-display-container w3-card-4" style="margin-left: auto; margin-right: auto; margin-top:60px; width: 100%">
        <span onclick="this.parentElement.style.display='none'"
        class="w3-button w3-large w3-display-topright">&times;</span>
        <h3>Success!</h3>
        <p>{{ session()->get('success') }}</p>
      </div>
    @endif

    <table id="contacts">

        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birth Date</th>
            <th></th>
        </tr>

        @forelse($contacts as  $id => $contact)
        <tr>
            <td class="w3-center">{{ $contact['fields']['core']['firstname']['value'] }} {{ $contact['fields']['core']['lastname']['value'] }}</td>
            <td class="w3-center">{{ $contact['fields']['core']['email']['value'] }}</td>
            <td class="w3-center">{{ $contact['fields']['core']['phone']['value'] }}</td>
            <td class="w3-center">{{ $contact['fields']['core']['birth_date']['value'] }}</td>
            <td class="w3-center">
                <a href="/contacts/edit/{{ $id }}" class="w3-button w3-pale-blue w3-border w3-border-blue">
                    <i class="fa fa-edit"></i>&nbsp; Edit &nbsp;
                </a>
                <form action="{{ route('contacts.delete', ['id' => $id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="w3-button w3-pale-red w3-border w3-border-red"
                    onclick="return confirm('Are you sure you want to delete this contact ?')" title="Delete"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No Contacts Found!</td>
        </tr>
        @endforelse

    </table>

<!-- End Page Content -->
</div>

@endsection