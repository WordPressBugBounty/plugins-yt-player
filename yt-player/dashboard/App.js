import { Navigate, Route, HashRouter as Router, Routes } from 'react-router-dom';
import ListDemo from '../../bpl-tools/Admin/Demos/ListDemos';
import FeatureCompare from '../../bpl-tools/Admin/FeatureCompare/FeatureCompare';
import Pricing from '../../bpl-tools/Admin/Pricing/Pricing';
import Layout from './Layout/Layout';
import Welcome from './Pages/Welcome';
import { demoInfo, featureCompareInfo, pricingInfo } from './utils/data';

const App = (props) => {
  const { isPremium } = props;

  return (
    <Router>
      <Routes>
        <Route path='/' element={<Layout {...props} />} >

          {/* ✅ fixed: absolute path redirect */}
          <Route index element={<Navigate to="/welcome" replace />} />

          <Route path="welcome" element={<Welcome {...props} />} />
          <Route path="demos" element={<ListDemo demoInfo={demoInfo} {...props} />} />
          <Route path="pricing" element={<Pricing pricingInfo={pricingInfo} options={{}} {...props} />} />
          {!isPremium && (
            <Route
              path="feature-comparison"
              element={
                <FeatureCompare
                  featureCompareInfo={featureCompareInfo}
                  {...props}
                />
              }
            />
          )}
          <Route path="*" element={<Navigate to="welcome" replace />} />
        </Route>
      </Routes>
    </Router>
  )
}

export default App;