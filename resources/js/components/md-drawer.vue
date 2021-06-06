<template>
    <div>
        <!-- <b-button v-b-toggle.sidebar-no-header>Toggle Sidebar</b-button> -->

        <b-sidebar
            id="sidebar-no-header"
            aria-labelledby="sidebar-no-header-title"
            no-header
            shadow
            width="200px"
        >
            <template #default="{ hide }">
                <div class="p-3">
                    <h4 id="sidebar-no-header-title">Algorithms</h4>

                    <nav class="mb-3">
                        <b-nav vertical>
                            <b-nav-item href="/bubble" @click="hide"
                                >Bubble Sort</b-nav-item
                            >
                            <b-nav-item href="/insertion" @click="hide"
                                >Insertion Sort</b-nav-item
                            >
                            <b-nav-item href="/merge" @click="hide"
                                >Merge Sort</b-nav-item
                            >
                        </b-nav>
                    </nav>

                    <b-button
                        variant="outline-secondary"
                        size="sm"
                        block
                        @click="hide"
                        >Close</b-button
                    >
                </div>
            </template>
        </b-sidebar>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
