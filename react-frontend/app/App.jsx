import Card from '../src/components/ui/Card.jsx';
import Form from '../src/components/ui/Form.jsx';
import Counter from '../src/components/ui/Counter.jsx';
import List from '../src/components/ui/List.jsx';
import Post from '../src/components/ui/Post.jsx';
import './app.css';

export default function App() {
  return (
    <main className="app-shell">
      <Card
        name="Garcia"
        description="This is me."
      />
      <Card
        name="Johnfritch"
        description="This is me again."
      />
      <Form />
      <Counter />
      <List />
      <Post />
    </main>
  );
}
