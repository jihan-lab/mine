@extends('layouts.dashboard')

@section('title')
    Dashboard Transactions Page
@endsection
@section('content')
    <div
        class="section-content section-dashboard-home"
        data-aos="fade-up"
        >
        <div class="container-fluid">
            <div class="dashboard-heading">
            <h2 class="dashboard-title">{{ $transactions->code }}</h2>
            <p class="dashboard-subtitle">
                Transaction Details
            </p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                        <img
                            src="{{ Storage::url($transactions->products->galleries->first()->photo ?? '') }}"
                            alt=""
                            class="w-100 mb-3"
                        />
                        </div>
                        <div class="col-12 col-md-8">
                        <div class="row">
                            <div class="col-12 col-md-6">
                            <div class="product-title">Customer Name</div>
                            <div class="product-subtitle">{{ $transactions->transactions->users->name }}</div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title">Product Name</div>
                            <div class="product-subtitle">{{ $transactions->products->name }}</div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title">
                                Date of Transaction
                            </div>
                            <div class="product-subtitle">
                                {{ $transactions->created_at }}
                            </div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title">Status</div>
                            <div class="product-subtitle text-danger">
                                {{ $transactions->shipping_status }}
                            </div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title">Total Amount</div>
                            <div class="product-subtitle">{{ $transactions->transactions->total_price }}</div>
                            </div>
                            <div class="col-12 col-md-6">
                            <div class="product-title">Mobile</div>
                            <div class="product-subtitle">
                                {{ $transactions->transactions->users->phone_number }}
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <form action="{{ route('dashboard-transactions-update', $transactions->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 mt-4">
                            <h5>
                                Shipping Informations
                            </h5>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                <div class="product-title">Address 1</div>
                                <div class="product-subtitle">
                                    {{ $transactions->transactions->users->address_one }}
                                </div>
                                </div>
                                <div class="col-12 col-md-6">
                                <div class="product-title">Address 2</div>
                                <div class="product-subtitle">
                                    {{ $transactions->transactions->users->address_two }}
                                </div>
                                </div>
                                <div class="col-12 col-md-6">
                                <div class="product-title">
                                    Province
                                </div>
                                <div class="product-subtitle">
                                    {{ App\Models\Province::find($transactions->transactions->users->provinces_id)->name }}
                                </div>
                                </div>
                                <div class="col-12 col-md-6">
                                <div class="product-title">City</div>
                                <div class="product-subtitle">
                                    {{ App\Models\Regency::find($transactions->transactions->users->regencies_id)->name }}
                                </div>
                                </div>
                                <div class="col-12 col-md-6">
                                <div class="product-title">Postal Code</div>
                                <div class="product-subtitle">{{ $transactions->transactions->users->zip_code }}</div>
                                </div>
                                <div class="col-12 col-md-6">
                                <div class="product-title">Country</div>
                                <div class="product-subtitle">
                                    {{ $transactions->transactions->users->country }}
                                </div>
                                </div>
                                <div class="col-12">
                                <div class="row">
                                    <div class="col-md-3">
                                    <div class="product-title">Status</div>
                                    <select
                                        name="shipping_status"
                                        id="status"
                                        class="form-control"
                                        v-model="status"
                                    >
                                        <option value="UNPAID">Unpaid</option>
                                        <option value="PENDING">Pending</option>
                                        <option value="SHIPPING">Shipping</option>
                                        <option value="SUCCESS">Success</option>
                                    </select>
                                    </div>
                                    <template v-if="status == 'SHIPPING'">
                                    <div class="col-md-3">
                                        <div class="product-title">
                                        Input Resi
                                        </div>
                                        <input
                                        class="form-control"
                                        type="text"
                                        name="resi"
                                        id="openStoreTrue"
                                        v-model="resi"
                                        />
                                    </div>
                                    <div class="col-md-2">
                                        <button
                                        type="submit"
                                        class="btn btn-success btn-block mt-4"
                                        >
                                        Update Resi
                                        </button>
                                    </div>
                                    </template>
                                </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success btn-lg mt-4">
                                        Save Now
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var transactionDetails = new Vue({
        el: "#transactionDetails",
        data: {
          status: "{{ $transactions->shipping_status }}",
          resi: "{{ $transactions->resi }}",
        },
      });
    </script>
@endpush
