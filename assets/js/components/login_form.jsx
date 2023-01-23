import React, {useState} from "react";
import {post} from "../utils";
import {Alert, Button, Input} from "@material-tailwind/react";
import {FaSpinner} from "react-icons/fa";

export function LoginForm({onSuccess} = props) {
    const [username, setUsername] = useState('user1@gmail.com');
    const [password, setPassword] = useState('azerty');
    const [loading, setLoading] = useState(false);
    const [failed, setFailed] = useState(false);

    //useEffect(()=>{login()},[]);

    const login = async function () {
        setLoading(true);
        setFailed(false);
        try {
            let data = await post('/api/login', {username, password});
            if (onSuccess) onSuccess(data);
        } catch (response) {
            setFailed(true);
        } finally {
            setLoading(false);
        }
    }

    return (
        <div className="fixed inset-0 bg-black/30 shadow flex items-center justify-center">
            <div className="w-1/3 p-10 bg-white space-y-5">
                <Input label="Username" placeholder="Username" value={username} onInput={(e) => {
                    setUsername(e.target.value)
                }}/>
                <Input label="Password" type="password" placeholder="Password" value={password} onInput={(e) => {
                    setPassword(e.target.value)
                }}/>
                <Button onClick={() => login()}>Log in {loading &&
                <FaSpinner className="inline-block text-white animate-spin"/>}</Button>
                {failed && <Alert color="red">Username or password not valid !</Alert>}
            </div>
        </div>
    );
}