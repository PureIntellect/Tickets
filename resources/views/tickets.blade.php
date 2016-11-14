<spark-kiosk-tickets inline-template>
    <!-- Open Tickets List -->
        <div class="panel panel-default" v-cloak>
            <div class="panel-heading">Recent Tickets</div>
            <div class="panel-body">
                <table class="table table-borderless m-b-none">
                    <thead>
                        <th>Created By</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Category</th>
                        <th></th>
                    </thead>

                    <tbody>
                        <tr v-for="ticket in tickets">
                            <!-- Photo -->
                            <td>
                                <img v-if="ticket.creator" :src="ticket.creator.photo_url" class="spark-profile-photo">
                            </td>

                            <!-- Date -->
                            <td>
                                <div class="btn-table-align">
                                    @{{ ticket.created_at | datetime }}
                                </div>
                            </td>
                            <td>
                                <img :src="ticket.user.photo_url" class="spark-profile-photo">
                            </td>
                            <td>
                                @{{ticket.category}}
                            </td>

                            <!-- Edit Button -->
                            {{-- <td>
                                <button class="btn btn-primary" @click="editAnnouncement(announcement)">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td> --}}

                            <!-- Delete Button -->
                            <td>
                                {{-- <button class="btn btn-danger-outline" @click="approveAnnouncementDelete(announcement)">
                                    <i class="fa fa-times"></i>
                                </button> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</spark-kiosk-notify>
