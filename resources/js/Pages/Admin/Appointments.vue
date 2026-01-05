<template>
  <AdminLayout>
     <main class="p-6 md:ml-64 pt-20 bg-gray-50 min-h-screen">
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
     <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center mb-6">
  <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
    Appointments
  </h1>

  <div class="flex flex-col gap-2 sm:flex-row sm:gap-4 w-full md:w-auto">
    <input
      v-model="filters.date"
      type="date"
      @change="filterAppointments"
      class="w-full sm:w-auto border-gray-300 rounded-md shadow-sm"
    >

    <select
      v-model="filters.status"
      @change="filterAppointments"
      class="w-full sm:w-auto border-gray-300 rounded-md shadow-sm"
    >
      <option value="">All Status</option>
      <option value="pending">Pending</option>
      <option value="approved">Approved</option>
      <option value="cancelled">Cancelled</option>
    </select>
  </div>
</div>


      <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
          <li v-for="appointment in appointments.data" :key="appointment.id">
            <div class="px-4 py-4 sm:px-6">
              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-1 min-w-0">
                  <div class="flex items-center">
                    <p class="text-sm font-medium text-indigo-600 truncate">
                      {{ appointment.user.name }} ({{ appointment.user.email }})
                    </p>
                    <span :class="statusClass(appointment.status)" class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                      {{ appointment.status }}
                    </span>
                  </div>
                  <div class="mt-2 sm:flex sm:justify-between">
                    <div class="sm:flex">
                      <p class="flex items-center text-sm text-gray-500">
                        {{ appointment.service.name }} • {{ appointment.service.duration_minutes }} min
                      </p>
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                      <CalendarIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" />
                      {{ formatDate(appointment.date) }} at {{ formatTime(appointment.start_time) }}
                    </div>
                  </div>
                  <p v-if="appointment.notes" class="mt-2 text-sm text-gray-600">
                    Notes: {{ appointment.notes }}
                  </p>
                </div>
               <div class="mt-4 sm:mt-0 sm:ml-4 flex flex-wrap gap-2">
  <!-- APPROVE -->
  <button
    v-if="appointment.status === 'pending'"
    @click="updateStatus(appointment, 'approved')"
    class="px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 text-sm"
  >
    Approve
  </button>

  <!-- COMPLETE -->
  <button
    v-if="appointment.status === 'approved'"
    @click="updateStatus(appointment, 'completed')"
    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 text-sm"
  >
    Complete
  </button>

  <!-- CANCEL -->
  <button
    v-if="['pending','approved'].includes(appointment.status)"
    @click="updateStatus(appointment, 'cancelled')"
    class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 text-sm"
  >
    Cancel
  </button>
</div>

              </div>
            </div>
          </li>
        </ul>

        <!-- Pagination -->
        <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
          <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
              Showing <span class="font-medium">{{ appointments.from }}</span> to 
              <span class="font-medium">{{ appointments.to }}</span> of 
              <span class="font-medium">{{ appointments.total }}</span> results
            </p>
          </div>
         <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
            <Link 
               v-if="appointments.prev_page_url"
              :href="appointments.prev_page_url"
              :class="['relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50', 
              { 'opacity-50 cursor-not-allowed': !appointments.prev_page_url }]"
            >
              Previous
            </Link>
            <Link 
               v-if="appointments.prev_page_url"
              :href="appointments.next_page_url"
              :class="['ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50',
              { 'opacity-50 cursor-not-allowed': !appointments.next_page_url }]"
            >
              Next
            </Link>
         <button
  v-if="cancelledCount > 0"
  @click="deleteCanceled"
  class="w-full sm:w-auto bg-red-600 text-white px-4 py-2 rounded"
>
  Delete All Canceled
</button>
          </div>
        </nav>
      </div>
    </div>
  </div>
  </main>
  </AdminLayout>
</template>

<script setup>
import { ref, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2'
import AdminLayout from './Components/AdminLayout.vue'
import { CalendarIcon } from '@heroicons/vue/24/outline';

const deleteCanceled = () => {
  Swal.fire({
    title: 'Are you sure?',
    text: "This will delete all canceled appointments!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete all!',
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(route('admin.appointments.delete-canceled'), {
        onSuccess: () => {
          Swal.fire(
            'Deleted!',
            'All canceled appointments have been deleted.',
            'success'
          )
          cancelledCount.value = 0;
        }
      })
    }
  })
}
const props = defineProps({
  appointments: Object,
  filters: Object,
  cancelledCount: Number,
});


const cancelledCount = ref(props.cancelledCount);

const filters = ref({
  date: props.filters.date || '',
  status: props.filters.status || '',
});

function filterAppointments() {
  router.get(route('admin.appointments.index'), filters.value, {
    preserveState: true,
    replace: true,
  });
}

function updateStatus(appointment, status) {
  Swal.fire({
    title: 'Confirm Action',
    text: `Change status to ${status.toUpperCase()}?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#2563eb',
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel',
  }).then((result) => {
    if (result.isConfirmed) {
      router.patch(
        route('admin.appointments.update-status', appointment.id),
        { status },
        { preserveScroll: true }
      )
    }
  })
}


function formatDate(dateString) {
  return new Date(dateString).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric'
  });
}

function formatTime(timeString) {
  const [hours, minutes] = timeString.split(':');
  const hour = parseInt(hours);
  const ampm = hour >= 12 ? 'PM' : 'AM';
  const formattedHour = hour % 12 || 12;
  return `${formattedHour}:${minutes} ${ampm}`;
}

function statusClass(status) {
  const classes = {
    pending: 'bg-yellow-100 text-yellow-800',
    approved: 'bg-green-100 text-green-800',
    cancelled: 'bg-red-100 text-red-800',
    completed: 'bg-blue-100 text-blue-800',
  };
  return classes[status] || 'bg-gray-100 text-gray-800';
}
</script>