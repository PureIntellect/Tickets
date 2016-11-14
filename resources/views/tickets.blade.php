<spark-kiosk-tickets inline-template>
    <div class="panel panel-default">
        <div class="panel-heading">Create Ticket</div>

        <div class="panel-body">
            <div class="alert alert-info">
                Notifications you create here will be sent to the "Notifications" section of
                the notifications modal window for that specific user.
            </div>

            <form class="form-horizontal" role="form">

                <!-- User -->
                <div class="form-group">
                    <label class="col-md-4 control-label">User</label>

                    <div class="col-md-6">
                        <select class="form-control" name="user_id" v-model="newNotification.user_id">
                            <option value="">Choose User...</option>
                            <option value="@{{ usr.id }}" v-for="usr in users">@{{ usr.name }}</option>
                        </select>
                    </div>
                </div>

                <!-- Ticket -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Ticket</label>

                    <div class="col-md-6">
                        <textarea class="form-control" name="ticket"  v-model="newTicket.body" rows="7" style="font-family: monospace;">
                        </textarea>
                    </div>
                </div>

                <!-- Action Text -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Action Button Text</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="action_text"  v-model="newTicket.action_text">
                    </div>
                </div>

                <!-- Action URL -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Action Button URL</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="action_url"  v-model="newTicket.action_url">
                    </div>
                </div>

                <!-- Create Button -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <button type="submit" class="btn btn-primary" @click.prevent="createTicket">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Recent Tickets List -->
        <div class="panel panel-default" v-cloak>
            <div class="panel-heading">Recent Tickets</div>

            <div class="panel-body">
                <table class="table table-borderless m-b-none">
                    <thead>
                        <th>Created By</th>
                        <th>Date</th>
                        <th>User</th>
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

                            <!-- Edit Button -->
                            {{-- <td>
                                <button class="btn b`tn-primary" @click="editAnnouncement(announcement)">
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
