import { useState } from 'react';

export default function Form() {
    // Events
  const [name, setName] = useState("");
  const handleSubmit = (event) => {
    event.preventDefault();
    // console.log(`Submitted: ${name}`);
    window.alert(`Submitted: ${name}`);
  };

  return (
    <form method="POST" onSubmit={handleSubmit}>
      <input
        type="text"
        value={name}
        onChange={(event) => setName(event.target.value)}
        placeholder="Enter your name"
      />
      <button type="submit">Submit</button>
    </form>
  );
}
