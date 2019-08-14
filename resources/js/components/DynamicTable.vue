<template>
  <div>
    <div class="table-responsive">
      <table
        v-if="mappedPaginationItems.length > 0"
        :class="tableClass"
      >
        <thead :class="theadClass">
          <tr>
            <th 
              v-for="(value, index) in columns" 
              :key="index"
              @click="sort(index)"
            >
              {{ value }}<span 
                v-if="currentSortKey === index" 
                :class="caretClass" 
                class="pl-2"
              />
            </th>
            <slot name="th" />
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="item in mappedPaginationItems" 
            :key="item.id"
          >
            <td 
              v-for="(value, index) in item" 
              :key="index"
            >
              {{ shortenValue(value) }}
            </td>
            <slot 
              v-bind="item" 
              name="td"
            />
          </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer bg-white">
      <Pagination
        v-show="mappedPaginationItems.length > 0"
        ref="pagination"
        :items="orderedItems"
        :per-page="perPage"
      />
    </div>
  </div>
</template>

<script>
import { strLimit } from "@/utilities/helpers"
import { filter, map, pick, orderBy } from "lodash"

export default {
    name: "DynamicTable",

    props: {
        tableClass: {
            default: "table table-borderless table-hover",
            type: String
        },

        theadClass: {
            default: "",
            type: String
        },

        columns: {
            required: true,
            type: Object
        },

        items: {
            default() {
                return []
            },
            required: true,
            type: Array
        },

        perPage: {
            default: 12,
            type: Number
        },

        sortDirection: {
            default: "desc",
            type: String,
        },

        sortKey: {
            default: null,
            type: String,
        }
    },

    data() {
        return {
            currentSortKey: this.sortKey || Object.keys(this.columns)[0],
            currentSortDirection: this.sortDirection,
            mappedPaginationItems: [],
            search: "",
        }
    },

    computed: {
        caretClass() {
            return this.currentSortDirection === "asc" ? "fa fa-caret-up" : "fa fa-caret-down"
        },

        filteredItems() {
            return filter(this.items, (item)=> {
                return Object.values(item).toString().toLowerCase().indexOf(this.search.toLowerCase()) > -1
            })
        },

        orderedItems() {
            return orderBy(this.filteredItems, this.currentSortKey, this.currentSortDirection)
        }
    },

    mounted() {
        this.$watch(() => {
            this.mappedPaginationItems = map(this.$refs.pagination.paginator.paginationItems, (item)=> {
                return pick(item, Object.keys(this.columns))
            })
        })
    },

    methods: {
        shortenValue(value) {
            return strLimit(value)
        },

        sort(column) {
            if (column === this.currentSortKey) {
                return this.currentSortDirection = this.currentSortDirection === "asc" ? "desc" : "asc"
            }

            return this.currentSortKey = column
        }
    }
}
</script>
