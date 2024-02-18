<template>
    <div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nivel</th>
                    <th scope="col">Recompensa</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items" :key="item.id">
                    <td :id="'rewards_level_' + index">{{ item.level }}</td>
                    <td><input :id="'rewards_reward_' + index" name="rewards[]" class="form-control" :value="item.reward" @change="handleItemChange($event, index)"></td>
                    <td>
                        <button
                            @click="moveUp(index)"
                            :disabled="index === 0"
                            type="button"
                            class="btn btn-primary m-1"
                        >
                            <i class="bx bx-up-arrow-alt align-middle"></i>
                        </button>
                        <button
                            @click="moveDown(index)"
                            :disabled="index === items.length - 1"
                            type="button"
                            class="btn btn-primary m-1"
                        >
                            <i class="bx bx-down-arrow-alt align-middle"></i>
                        </button>
                        <button
                            @click="removeItem(index)"
                            type="button"
                            class="btn btn-danger m-1"
                        >
                            <i class="bx bx-trash align-middle"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>{{ nextLevel }}</td>
                    <td>
                        <input
                            v-model="newItem.reward"
                            class="form-control"
                            placeholder="Recompensa"
                        />
                    </td>
                    <td>
                        <button
                            @click="addItem"
                            type="button"
                            class="btn btn-success"
                        >
                            Agregar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { ref, computed, onMounted } from "vue";
import axios from "axios";

export default {
    props: ["shopSubdomain"],
    setup(props) {
        const items = ref([]);
        const newItem = ref({
            level: null,
            reward: "",
        });

        const fetchItems = async () => {
            try {
                const response = await axios.get(
                    `/dashboard/shop_levels/${props.shopSubdomain}`
                );
                if (response.status === 200) {
                    items.value = response.data;
                }
            } catch (error) {
                console.error("Error al obtener elementos:", error);
            }
        };

        const nextLevel = computed(() => {
            return items.value.length > 0
                ? items.value[items.value.length - 1].level + 1
                : 1;
        });

        const moveUp = (index) => {
            if (index > 0) {
                swapItems(index, index - 1);
            }
        };

        const moveDown = (index) => {
            if (index < items.value.length - 1) {
                swapItems(index, index + 1);
            }
        };

        const swapItems = (indexA, indexB) => {
            const tempReward = items.value[indexA].reward;
            items.value[indexA].reward = items.value[indexB].reward;
            items.value[indexB].reward = tempReward;
            items.value = [...items.value];
        };

        const addItem = () => {
            const newId = items.value.length + 1;
            items.value.push({
                id: newId,
                level: nextLevel.value,
                reward: newItem.value.reward,
            });

            newItem.value.reward = "";
        };

        const removeItem = (index) => {
            items.value.splice(index, 1);

            // Recalcular niveles
            for (let i = index; i < items.value.length; i++) {
                items.value[i].level = i + 1;
            }
        };

        const handleItemChange = (event, index) => {
            const newValue = event.target.value;

            items.value[index].reward = newValue;
        };

        onMounted(async () => {
            await fetchItems();
        });

        return {
            items,
            newItem,
            nextLevel,
            moveUp,
            moveDown,
            addItem,
            removeItem,
            handleItemChange
        };
    },
};
</script>
