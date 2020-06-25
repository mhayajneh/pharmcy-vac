<template>
  <tr>
    <th scope="row">1</th>
    <td>Alabama</td>
    <td>AL</td>
    <td>15 minutes ago</td>
    <td>
      <form method="POST" action="https://ursinus.wiser.ws/states/AL" accept-charset="UTF-8">
        <input name="_method" type="hidden" value="PUT">
        <div class="input-group input-group-sm">
          <input name="donations" type="text" value="15" class="form-control form-control-sm">
          <div class="input-group-append">
            <button type="submit" class="btn btn-outline-secondary">Update</button>
          </div>
        </div>
      </form>
    </td>
  </tr>
</template>

<script>
  export default {
    /*
     * The component's properties.
     */
    props: {
      state: { type: Object }
    },
    /*
     * The component's data.
     */
    data() {
      return {
        donations: 0
      };
    },
    /*
     * The component's computed properties.
     */
    computed: {},

    /**
     * Prepare the component (Vue 2.x).
     */
    mounted() {
        this.prepare();
    },

    methods: {
      /**
       * Prepare the component.
       */
      prepare() {
        //
      },
      /**
       * Update existing encrypted data.
       */
      update() {

        axios.put('/states/' + this.state.abbreviation, {
                'donations' : this.donations,
              })
              .then(response => {
                  console.log(response);
              })
      },
    }
  }
</script>
