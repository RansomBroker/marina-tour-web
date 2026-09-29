<div>
	<!-- Welcome Banner Card -->
	<div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-primary to-accent p-8 text-white shadow-xl shadow-primary/10 anim-fade-up">
		<div class="absolute -right-20 -bottom-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
		<div class="absolute -right-10 -top-40 w-80 h-80 bg-accent/20 rounded-full blur-3xl"></div>

		<div class="relative z-10 max-w-xl">
			<span class="inline-block px-3 py-1 rounded-full bg-white/25 backdrop-blur-md text-[10px] uppercase font-bold tracking-widest mb-4">
				System Operational
			</span>
			<h1 class="text-3xl sm:text-4xl font-bold font-heading mb-2 leading-tight">
				Welcome Back, {{ Auth::user()->name }}!
			</h1>
			<p class="text-white/80 text-sm sm:text-base font-body leading-relaxed">
				Everything is running smoothly. Here's a brief overview of your business metrics for Smith Travel Bali.
			</p>
		</div>
	</div>

	<!-- Stats Section -->
	<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
		<!-- Card 1 -->
		<div class="bg-card p-6 rounded-2xl border border-border/60 hover:border-primary/20 hover:shadow-lg transition-all duration-300 group">
			<div class="flex justify-between items-start mb-4">
				<div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300">
					<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
				</div>
				<span class="text-xs font-semibold text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-full flex items-center gap-0.5">
					Active
				</span>
			</div>
			<p class="text-muted-foreground font-body text-xs font-semibold uppercase tracking-wider mb-1">Total Bookings</p>
			<h3 class="text-2xl font-bold font-heading leading-none text-foreground">{{ $totalBookings }}</h3>
		</div>

		<!-- Card 2 -->
		<div class="bg-card p-6 rounded-2xl border border-border/60 hover:border-accent/20 hover:shadow-lg transition-all duration-300 group">
			<div class="flex justify-between items-start mb-4">
				<div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center text-accent group-hover:scale-110 transition-transform duration-300">
					<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
				</div>
				<span class="text-xs font-semibold text-emerald-500 bg-emerald-500/10 px-2 py-0.5 rounded-full flex items-center gap-0.5">
					Confirmed
				</span>
			</div>
			<p class="text-muted-foreground font-body text-xs font-semibold uppercase tracking-wider mb-1">Total Revenue</p>
			<h3 class="text-xl font-bold font-heading leading-none text-foreground">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
		</div>

		<!-- Card 3 -->
		<div class="bg-card p-6 rounded-2xl border border-border/60 hover:border-primary/20 hover:shadow-lg transition-all duration-300 group">
			<div class="flex justify-between items-start mb-4">
				<div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300">
					<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
				</div>
				<span class="text-xs font-semibold text-muted-foreground bg-muted/60 px-2 py-0.5 rounded-full">Catalog</span>
			</div>
			<p class="text-muted-foreground font-body text-xs font-semibold uppercase tracking-wider mb-1">Tour Packages</p>
			<h3 class="text-2xl font-bold font-heading leading-none text-foreground">{{ $totalPackages }}</h3>
		</div>

		<!-- Card 4 -->
		<div class="bg-card p-6 rounded-2xl border border-border/60 hover:border-accent/20 hover:shadow-lg transition-all duration-300 group">
			<div class="flex justify-between items-start mb-4">
				<div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center text-accent group-hover:scale-110 transition-transform duration-300">
					<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
				</div>
				<span class="text-xs font-semibold text-amber-500 bg-amber-500/10 px-2 py-0.5 rounded-full">Inquiries</span>
			</div>
			<p class="text-muted-foreground font-body text-xs font-semibold uppercase tracking-wider mb-1">Total Inquiries</p>
			<h3 class="text-2xl font-bold font-heading leading-none text-foreground">{{ $totalInquiries }}</h3>
		</div>
	</div>

	<!-- Table Section: Recent Bookings -->
	<div class="bg-card rounded-3xl border border-border/60 shadow-sm overflow-hidden mt-8">
		<div class="p-6 sm:p-8 border-b border-border/60 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
			<div>
				<h2 class="text-xl font-bold font-heading text-foreground">Recent Booking Transactions</h2>
				<p class="text-xs text-muted-foreground font-body mt-0.5">List of customers who registered tour packages recently.</p>
			</div>
			<a href="{{ route('admin.bookings') }}" class="inline-flex items-center justify-center px-4 py-2 bg-muted/65 hover:bg-muted text-foreground text-xs font-bold font-body rounded-xl border border-border/50 transition-all duration-200">
				View All Bookings
			</a>
		</div>

		<div class="overflow-x-auto">
			<table class="w-full text-left border-collapse">
				<thead>
					<tr class="bg-muted/20 border-b border-border/60 text-muted-foreground font-body text-[11px] font-bold uppercase tracking-wider">
						<th class="py-4 px-6 sm:px-8">Client Name</th>
						<th class="py-4 px-6">Chosen Itinerary</th>
						<th class="py-4 px-6">Transaction Date</th>
						<th class="py-4 px-6">Total Cost</th>
						<th class="py-4 px-6">Status</th>
						<th class="py-4 px-6 sm:px-8 text-right">Actions</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-border/60 text-sm font-body text-foreground">
					@forelse($recentBookings as $booking)
						@php
							$words = explode(' ', $booking->full_name);
							$initials = '';
							foreach ($words as $w) {
								$initials .= strtoupper(substr($w, 0, 1));
							}
							$initials = substr($initials, 0, 2);
						@endphp
						<tr class="hover:bg-muted/15 transition-all">
							<td class="py-4 px-6 sm:px-8">
								<div class="flex items-center gap-3">
									<div class="w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center font-semibold text-xs shrink-0">
										{{ $initials ?: 'C' }}
									</div>
									<div>
										<p class="font-semibold text-foreground leading-none">{{ $booking->full_name }}</p>
										<span class="text-[10px] text-muted-foreground font-medium mt-0.5 block">{{ $booking->email }}</span>
									</div>
								</div>
							</td>
							<td class="py-4 px-6">
								<span class="font-medium text-foreground">{{ $booking->package->name ?? 'N/A' }}</span>
							</td>
							<td class="py-4 px-6 text-muted-foreground">
								{{ $booking->created_at->format('M d, Y') }}
							</td>
							<td class="py-4 px-6 font-semibold text-foreground">
								Rp {{ number_format($booking->total_price, 0, ',', '.') }}
							</td>
							<td class="py-4 px-6">
								@if($booking->status === 'new')
									<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-500">
										<span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
										New
									</span>
								@elseif($booking->status === 'follow_up')
									<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-500">
										<span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
										Follow Up
									</span>
								@elseif($booking->status === 'confirmed')
									<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-500">
										<span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
										Confirmed
									</span>
								@elseif($booking->status === 'assigned')
									<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-500">
										<span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
										Assigned
									</span>
								@elseif($booking->status === 'completed')
									<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-teal-500/10 text-teal-500">
										<span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span>
										Completed
									</span>
								@else
									<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-500">
										<span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
										Cancelled
									</span>
								@endif
							</td>
							<td class="py-4 px-6 sm:px-8 text-right">
								<a href="{{ route('admin.bookings') }}" class="px-3 py-1.5 bg-muted/60 hover:bg-primary/10 text-muted-foreground hover:text-primary rounded-lg text-xs font-semibold transition-all inline-block">
									Manage
								</a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="6" class="py-8 px-6 text-center text-muted-foreground font-body text-sm">
								No bookings found.
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
