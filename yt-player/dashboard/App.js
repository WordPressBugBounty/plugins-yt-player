import { Toaster } from 'react-hot-toast';
import {HashRouter, Navigate, Route, Routes } from 'react-router-dom';
import Layout from './Layout/Layout';
import DemoTwo from './Pages/DemoTwo/DemoTwo';
import Video from './Pages/Video/Video';

const App = () => {
  return (
    <HashRouter>
      <Toaster position="bottom-center" />
      <Routes>
        <Route path="/preview" element={<Layout><div style={{ width: "70%", margin: "0 auto" }}><DemoTwo /></div></Layout>} />
        <Route path="/video" element={<Video />} />

        {/* When no routes match, it will redirect to this route path. Note that it should be registered above. */}
        <Route path="*" element={<Navigate to="/video" replace />} />
      </Routes>
    </HashRouter>
  )
}

export default App;