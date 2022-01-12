<!--
https://tailwindcomponents.com/component/alpinejs-multiple-select-dropdown-with-tags-filter
-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.7.1/cdn.js" defer ></script>

<select id="select2" name="select2[]" class="hidden" multiple>
    <option value="above">Above</option>
    <option value="after">After</option>
    <option value="back" selected>Back</option>
    <option value="behind" selected>Behind</option>
    <option value="before" selected>Before</option>
    <option value="beyond" selected>Beyond</option>
    <option value="forward">Forward</option>
    <option value="front">Front</option>
    <option value="later">Later</option>
    <option value="under">Under</option>
</select>

<div class="relative flex" x-data="{ ...selectMultiple('select2') }">

    <!-- Selected -->
    <div class="flex flex-wrap border border-teal-400 rounded-3xl"
         @click="isOpen = true;"
         @keydown.arrow-down.prevent="if(dropdown.length > 0) document.getElementById(uniqueId+'_'+dropdown[0].index).focus();">

        <template x-for="(option,index) in selected;" :key="option.value">
            <p class="m-1 self-center p-2 text-xs whitespace-nowrap rounded-3xl bg-teal-200 cursor-pointer hover:bg-rose-400"
               x-text="option.text"
               @click="toggle(option)">
            </p>
        </template>

        <input type="text" placeholder="Filter options" class="pl-2 rounded-3xl h-10"
               x-model="term"
               x-ref="input" />
    </div>

    <!-- Dropdown -->
    <div class="absolute mt-12 z-10 w-full max-h-72 overflow-y-auto rounded-xl bg-teal-100 "
         x-show="isOpen"
         x-init="$el.id = uniqueId;"
         @mousedown.away="isOpen = false">

        <template x-for="(option,index) in dropdown" :key="option.value">
            <div class="cursor-pointer hover:bg-teal-50 focus:bg-teal-200 focus:outline-none"
                 :class="(term.length > 0 && !option.text.toLowerCase().includes(term.toLowerCase())) && 'hidden';"
                 x-init="$el.id = uniqueId + '_' + option.index; $el.tabIndex = option.index;"
                 @click="toggle(option)"
                 @keydown.enter.prevent="toggle(option);"
                 @keydown.arrow-up.prevent="if ($el.previousElementSibling != null) $el.previousElementSibling.focus();"
                 @keydown.arrow-down.prevent="if ($el.nextElementSibling != null) $el.nextElementSibling.focus();">

                <p class="p-2"
                   x-text="option.text"></p>
            </div>
        </template>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('selectMultiple', (elSelectId) => ({

            elSelect: document.getElementById(elSelectId),
            uniqueId: 'selectMultiple_' + Math.random(),
            isOpen: false,
            term: '',

            selected: [],
            dropdown: [],

            // in the <select> element, set the attributes :
            //  "multiple" to avoid to Always set "selected" to the first item
            //  class="hidden" (better than hide it with javascript which has a slow reaction)
            init()
            {
                this.uniqueId += '_' + (this.elSelect.id ?? '') + '_' + (this.elSelect.name ?? '');

                for(var index=0; index < this.elSelect.options.length; index++)
                {
                    if (this.elSelect.options[index].selected)
                        this.selected.push(this.elSelect.options[index]);
                    else
                        this.dropdown.push(this.elSelect.options[index]);
                }
            },

            toggle(option)
            {
                var property1 = (option.selected == true) ? 'dropdown' : 'selected';
                var property2 = (option.selected == true) ? 'selected' : 'dropdown';

                option.selected = !option.selected;

                // add
                this[property1].push(option);

                // remove
                this[property2] = this[property2].filter((opt, index)=>{
                    return opt.value != option.value;
                });

                // reorder this.dropdown to their original select.options indexes
                if (property1 == 'dropdown')
                    this.dropdown.sort((opt1, opt2) => (opt1.index > opt2.index) ? 1 : -1)

                // after adding, re-focus the input
                if (option.selected)
                    this.$refs.input.focus();
            },
        }))
    });
</script>
