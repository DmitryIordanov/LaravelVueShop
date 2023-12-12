<script>
import axios from "axios";
export default {
    methods: {
        async handleProduct(data){
            await axios.post('http://localhost:8000/api/create', data);
        },
        async findProduct(id){
            const responce = await axios.get('http://localhost:8000/api/product/' + id);
            return responce.data;
        },
        async deleteProduct(id){
            const responce = await axios.put('http://localhost:8000/api/delete/' + id);
            return responce.data;
        }
    }
}
</script>
