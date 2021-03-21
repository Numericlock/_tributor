<template>
	<div class="list">
		<a :href="'/lists/'+list.id" v-for="list in listsData"><img class="common-list-icon" :src="'/img/list_icon/'+list.id+'.png'"></a>
	</div>
</template>
<script>
    export default {
        props: {
            listsData: {
                type: Array
            },
        }
	}
</script>