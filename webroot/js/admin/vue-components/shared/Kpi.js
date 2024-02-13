app.component('Kpi', {
    props: {
        title: String,
        count: Number | String,
        query: {
            default: null,
            type: Object
        },
        prefix: {
            default: null,
            type: String
        },
        model: String
    },
    template: `
      <div class="stats-small stats-small--1 card card-small">
          <div class="card-body p-0 d-flex">
              <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                  <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                      <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                  </div>
                  <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                      <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                  </div>
              </div>
              <div class="d-flex flex-column m-auto">
                  <div class="stats-small__data text-center">
                      <span class="stats-small__label text-uppercase">{{title}}</span>
                      <h6 class="stats-small__value count my-3" style="font-size: 32px;">{{prefix}}{{getFormattedCount()}}</h6>
                  </div>
              </div>
          </div>
      </div>
  `,
    data(props) {
        return {
            totalCount: props.count
        }
    },
    methods: {
        async fetchCount() {
            try {
                const resp = await getCount(this.model, this.query);
                if (resp.success) {
                    this.totalCount = resp.data;
                }
            } catch (error) {

            }
        },
        getFormattedCount() {
            const num = this.totalCount;
            const digits = 2;
            const lookup = [
                { value: 1, symbol: "" },
                { value: 1e3, symbol: "k" },
                { value: 1e6, symbol: "M" },
                { value: 1e9, symbol: "G" },
                { value: 1e12, symbol: "T" },
                { value: 1e15, symbol: "P" },
                { value: 1e18, symbol: "E" }
            ];
            const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
            var item = lookup.slice().reverse().find(function(item) {
                return num >= item.value;
            });
            return item ? (num / item.value).toFixed(digits).replace(rx, "$1") + item.symbol : "0";
        }
    },
    async mounted() {
        console.log("KPI loaded.");
        this.model && this.query ? await this.fetchCount() : null;

    }
});