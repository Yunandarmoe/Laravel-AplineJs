<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Alpine JS CRUD</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
  integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
  <div class="container-fluid mt-5" x-data="postCrud()">
    <h2>CRUD with Laravel and Alpine JS</h2>
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header text-light bg-primary">
              Create Post Table
          </div>
          <div class="card-body">
            <table class="table">
              <thead class="thead">
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <template x-for="(post, index) in posts" :key="index">
                  <tr>
                    <td x-text="post.id"></td>
                    <td x-text="post.title"></td>
                    <td x-text="post.body"></td>
                    <td>
                      <button @click.prevent="editData(post, index)"
                        class="btn btn-info">Edit</button>
                      <button @click.prevent="deleteData(post.id)"
                        class="btn btn-danger">Delete</button>
                    </td>
                  </tr>
                </template>
              </tbody>
            </table>
          </div>
        </div>
      </div> 
      <div class="col-4">
        <div class="card">
          <div class="card-header text-light bg-primary">
            <span x-show="addMode">Create Post</span>
            <span x-show="!addMode">Edit Post</span>
          </div>
          <div class="card-body">
            <form @submit.prevent="saveData" x-show="addMode">
              <div class="form-group">
                <label>Title</label>
                <input x-model="form.title" type="text" class="form-control" placeholder="Enter Title">
              </div>
              <div class="form-group">
                <label>Content</label>
                <input x-model="form.body" type="text" class="form-control" placeholder="Enter Content">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
            <form @submit.prevent="updateData" x-show="!addMode">
              <div class="form-group">
                <label>Title</label>
                <input x-model="form.title" type="text" class="form-control" placeholder="Enter Title">
              </div>
              <div class="form-group">
                <label>Content</label>
                <input x-model="form.body" type="text" class="form-control" placeholder="Enter Content">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger" @click.prevent="cancelEdit">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
  function postCrud() {
    return {  
      addMode: true,
        form: {
          id: '',
          name: '',
          email: '',
        },
        posts: [],
        init() {
          axios.get('/api/post')
          .then(response => {
            this.posts = response.data;
          })
        },
        saveData() {
          axios.post('/api/post', this.form)
          .then(response => {
            this.init();
            this.form = { 
              title: '', 
              body: '',
            };
          });
        },
        editData(post, index) {
          this.addMode = false
          this.form.title = post.title
          this.form.body = post.body
          this.form.id = post.id
        },
        updateData() {
          axios.put(`/api/post/${this.form.id}`,this.form)
          .then(response => {
            this.init();
            this.form = { 
              title: '', 
              body: '' 
            };
          });
        },
        deleteData(id) {
          axios.delete(`/api/post/${id}`)
          .then(response => {
              this.init();
          })
        },
        cancelEdit(){
          this.resetForm()
        },
        resetForm() {
          this.addMode = true
          this.form.title = ''
          this.form.body = ''
        }
    }
  }
</script>
</body>
</html>