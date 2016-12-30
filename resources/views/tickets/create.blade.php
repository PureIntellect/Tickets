<div class="panel panel-default">
  <div class="panel-heading">Create Ticket</div>
  <div class="panel-body">
      <div class="alert alert-info alert-dismissible" v-if="results == null">
          Create a ticket for a customer
      </div>
      <div class="alert alert-success alert-dismissible" v-if="results.status=='Success'">
          @{{ results.message }}
      </div>
      <form role="form" class="form-horizontal">
        <div class="row">
          <div class="col-md-4">
            <!-- User -->
            <div class="form-group" :class="{'has-error': newTicket.errors.has('user')}">
              <span class="help-block" v-show="newTicket.errors.has('user')">
                @{{ newTicket.errors.get('user') }}
              </span>
                <label class="col-md-4 control-label">User</label>
                <div class="col-md-6">
                    <select class="form-control" name="user" v-model="newTicket.user">
                        <option value="">Choose User...</option>
                        <option v-for="usr in users" :value="usr.id">@{{ usr.name }}</option>
                    </select>
                </div>
            </div>

            <!-- Category -->
            <div class="form-group" :class="{'has-error': newTicket.errors.has('category')}">
              <span class="help-block" v-show="newTicket.errors.has('category')">
                @{{ newTicket.errors.get('category') }}
              </span>
              <label class="col-md-4 control-label">Category</label>
              <div class="col-md-6">
                <select class="form-control" name="category" v-model="newTicket.category">
                  <option value="">Choose Category...</option>
                  <option v-for="cat in categories" :value="cat.id">@{{ cat.name }}</option>
                </select>
              </div>
            </div>

            <!-- Status -->
            <div class="form-group" :class="{'has-error': newTicket.errors.has('status')}">
                <label class="col-md-4 control-label">Status</label>
                <div class="col-md-6">
                    <select class="form-control" name="status" v-model="newTicket.status">
                        <option value="">Choose Status...</option>
                        <option v-for="stat in statuses" :value="stat.id">@{{ stat.name }}</option>
                    </select>
                </div>
            </div>

            <!-- Priority -->
            <div class="form-group" :class="{'has-error': newTicket.errors.has('priority')}">
                <label class="col-md-4 control-label">Priority</label>
                <div class="col-md-6">
                    <select class="form-control" name="priority" v-model="newTicket.priority">
                        <option value="">Choose Priority...</option>
                        <option v-for="pri in priorities" :value="pri.id">@{{ pri.name }}</option>
                    </select>
                </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="form-group" :class="{'has-error': newTicket.errors.has('title')}">
              <label class="col-md-2 control-label">Title</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="title" v-model="newTicket.title" />
              </div>
            </div>

            <!-- Ticket -->
            <div class="form-group" :class="{'has-error': newTicket.errors.has('message')}">
                <label class="col-md-2 control-label">Ticket</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="message"  v-model="newTicket.message" rows="6">
                    </textarea>
                </div>
            </div>

            <!-- Create Button -->
            <div class="form-group">
                <div class="col-md-offset-4 col-md-6 pull-right">
                    <button class="btn btn-primary" @click.prevent="createTicket" :disabled="newTicket.busy">
                        Create
                    </button>
                </div>
            </div>
          </div>
        </div>
      </form>
  </div>
</div>
