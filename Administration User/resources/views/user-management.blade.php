@extends('layout.master')

@section('title', 'User Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin_page/user-management.css') }}">
@endpush

@section('content')
    <div class="container-fluid poppins">
        <div class="usermanagement px-4">
            <h3>User Management</h3>
            <div class="flex items-center justify-between gap-4 mb-6">
                <div class="flex items-center gap-3 flex-1">
                    <input class="search-input" placeholder="Search..." />
                    <button class="search-button">Search</button>
                </div>
            </div>
            <div class="flex items-center gap-3 mb-6">
                <span class="text-black">Sort by:</span>
                <button class="sort-button">First Name</button>
                <button class="sort-button">Last Name</button>
                <button class="sort-button">Country</button>
                <button class="sort-button">Registered Date</button>
                <button class="sort-button">Updated Date</button>
            </div>
            <div class="sort-options-container">
                <ul class="sort-options">
                    <li>Ascending</li>
                    <li>Descending</li>
                </ul>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row col-lg-8 px-1">
                <h2 class="text-center text-main-p">User Accounts</h2>
                <p class="text-black mb-1 mt-2">Number of users: 8</p>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <table id="table-stripping" class="table table-stripping">
                        <thead>
                            <tr class="head-table bg-custom text-white rounded-header">
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Profile</th>
                                <th>Activities</th>
                                <th>Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="rounded-row">
                                <td>1</td>
                                <td>John</td>
                                <td>Doe</td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                            </tr>
                            <tr class="rounded-row">
                                <td>2</td>
                                <td>Jane</td>
                                <td>Doe</td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                            </tr>
                            <!-- Add more rows like this -->
                            <tr class="rounded-row">
                                <td>3</td>
                                <td>Michael</td>
                                <td>Smith</td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                            </tr>
                            <tr class="rounded-row">
                                <td>4</td>
                                <td>Ashley</td>
                                <td>Williams</td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                            </tr>
                            <tr class="rounded-row">
                                <td>5</td>
                                <td>William</td>
                                <td>Jones</td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                            </tr>
                            <tr class="rounded-row">
                                <td>6</td>
                                <td>Emily</td>
                                <td>Brown</td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                            </tr>
                            <tr class="rounded-row">
                                <td>7</td>
                                <td>Olivia</td>
                                <td>Miller</td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                            </tr>
                            <tr class="rounded-row">
                                <td>8</td>
                                <td>Benjamin</td>
                                <td>Davis</td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                                <td><button class="btn btn-primary">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden bg-custom-gray card h-100">
                        <div class="bg-custom px-4 py-3 text-white font-bold text-center">Profile Update</div>
                        <div class="border-t border-gray-200 p-2">
                            <ul>
                                <li class="text-gray-700 dark:text-gray-300">Jimmy James Profile has been updated.</li>
                                <li class="text-gray-700 dark:text-gray-300">Jimmy John Profile has been updated.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/table.js') }}"></script>
@endpush
