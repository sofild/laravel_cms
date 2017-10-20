<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Phpml\Classification\KNearestNeighbors;
use Phpml\Regression\LeastSquares;
use Phpml\Regression\SVR;
use Phpml\SupportVectorMachine\Kernel;

use Phpml\Clustering\KMeans; 
use Phpml\Clustering\DBSCAN;
use Phpml\Metric\Accuracy;

use Phpml\Metric\ConfusionMatrix;
use Phpml\Metric\ClassificationReport;

use Phpml\Classification\SVC;
use Phpml\Pipeline;
use Phpml\Preprocessing\Imputer;
use Phpml\Preprocessing\Normalizer;
use Phpml\Preprocessing\Imputer\Strategy\MostFrequentStrategy;

use Phpml\Association\Apriori;
/*
 * 1、监督式学习 <每组训练数据有一个明确的标识或结果>（朴素贝叶斯分类，最小二乘回归，逻辑回归，支撑矢量机，集成方法以及反向传递神经网络 等）
 *
 * 2、非监督式学习 <数据并不被特别标识，学习模型是为了推断出数据的一些内在结构> （奇异值分解、主成分分析，独立成分分析，Apriori算法以及k-Means算法 等）
 *
 * 3、半监督式学习 <输入数据部分被标识，部分没有被标识，这种学习模型可以用来进行预测，但是模型首先需要学习数据的内在结构以便合理的组织数据来进行预测> （图论推理算法（Graph Inference）或者拉普拉斯支持向量机等）
 *
 * 4、强化学习 <输入数据直接反馈到模型，模型必须对此立刻作出调整> （Q-Learning以及时间差学习）
 *
 * 在企业数据应用的场景下， 人们最常用的可能就是监督式学习和非监督式学习的模型。 在图像识别等领域，由于存在大量的非标识的数据和少量的可标识数据， 目前半监督式学习是一个很热的话题。 而强化学习更多的应用在机器人控制及其他需要进行系统控制的领域。
 *
 * 注：
 * <a>常见的回归算法包括：最小二乘法（Ordinary Least Square），逻辑回归（Logistic Regression），逐步式回归（Stepwise Regression），多元自适应回归样条（Multivariate Adaptive Regression Splines）以及本地散点平滑估计（Locally Estimated Scatterplot Smoothing）
 * <b>基于实例的算法常常也被称为“赢家通吃”学习或者“基于记忆的学习”。常见的算法包括 k-Nearest Neighbor(KNN), 学习矢量量化（Learning Vector Quantization， LVQ），以及自组织映射算法（Self-Organizing Map ， SOM）
 * <c>正则化方法通常对简单模型予以奖励而对复杂算法予以惩罚。常见的算法包括：Ridge Regression， Least Absolute Shrinkage and Selection Operator（LASSO），以及弹性网络（Elastic Net）。
 * <d>决策树算法根据数据的属性采用树状结构建立决策模型， 决策树模型常常用来解决分类和回归问题。常见的算法包括：分类及回归树（Classification And Regression Tree， CART）， ID3 (Iterative Dichotomiser 3)， C4.5， Chi-squared Automatic Interaction Detection(CHAID), Decision Stump, 随机森林（Random Forest）， 多元自适应回归样条（MARS）以及梯度推进机（Gradient Boosting Machine， GBM）。
 * <e>贝叶斯方法算法是基于贝叶斯定理的一类算法，主要用来解决分类和回归问题。常见算法包括：朴素贝叶斯算法，平均单依赖估计（Averaged One-Dependence Estimators， AODE），以及Bayesian Belief Network（BBN）。
 * <f>常见的基于核的算法包括：支持向量机（Support Vector Machine， SVM）， 径向基函数（Radial Basis Function ，RBF)， 以及线性判别分析（Linear Discriminate Analysis ，LDA)等。
 * <g>所有的聚类算法都试图找到数据的内在结构，以便按照最大的共同点将数据进行归类。常见的聚类算法包括 k-Means算法以及期望最大化算法（Expectation Maximization， EM）。
 * <h>关联规则学习通过寻找最能够解释数据变量之间关系的规则，来找出大量多元数据集中有用的关联规则。常见算法包括 Apriori算法和Eclat算法等。
 * <i>人工神经网络是机器学习的一个庞大的分支，有几百种不同的算法。（其中深度学习就是其中的一类算法，我们会单独讨论），重要的人工神经网络算法包括：感知器神经网络（Perceptron Neural Network）, 反向传递（Back Propagation）， Hopfield网络，自组织映射（Self-Organizing Map, SOM）。学习矢量量化（Learning Vector Quantization， LVQ）。
 * <j>很多深度学习的算法是半监督式学习算法，用来处理存在少量未标识数据的大数据集。常见的深度学习算法包括：受限波尔兹曼机（Restricted Boltzmann Machine， RBN）， Deep Belief Networks（DBN），卷积网络（Convolutional Network）, 堆栈式自动编码器（Stacked Auto-encoders）。
 * <k>像聚类算法一样，降低维度算法试图分析数据的内在结构，不过降低维度算法是以非监督学习的方式试图利用较少的信息来归纳或者解释数据。这类算法可以用于高维数据的可视化或者用来简化数据以便监督式学习使用。常见的算法包括：主成份分析（Principle Component Analysis， PCA），偏最小二乘回归（Partial Least Square Regression，PLS）， Sammon映射，多维尺度（Multi-Dimensional Scaling, MDS）,  投影追踪（Projection Pursuit）等。
 * <l>集成算法的主要难点在于究竟集成哪些独立的较弱的学习模型以及如何把学习结果整合起来。这是一类非常强大的算法，同时也非常流行。常见的算法包括：Boosting， Bootstrapped Aggregation（Bagging）， AdaBoost，堆叠泛化（Stacked Generalization， Blending），梯度推进机（Gradient Boosting Machine, GBM），随机森林（Random Forest）。
 */
class IndexController extends Controller
{
    //https://php-ml.readthedocs.io/en/latest/machine-learning/classification/naive-bayes/
    public function index(){
        /*
        $samples = [[1, 3, 1], [1, 4, 2], [2, 4, 1], [3, 1, 2], [4, 1, 3], [4, 2, 1], [5, 3, 1], [5, 2, 1]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b', 'c', 'c'];

        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);

        $r = $classifier->predict([5, 1, 2]);
        var_dump($r);
        */

        /*
        $samples = [[73676, 1996], [77006, 1998], [10565, 2000], [146088, 1995], [15000, 2001], [65940, 2000], [9300, 2000], [93739, 1996], [153260, 1994], [17764, 2002], [57000, 1998], [15000, 2000]];
        $targets = [2000, 2750, 15500, 960, 4400, 8800, 7100, 2550, 1025, 5900, 4600, 4400];
        $regression = new LeastSquares();
        $regression->train($samples, $targets);
        $r = $regression->predict([60000, 1996]);
        var_dump($r);
        */

        /*
        $samples = [[60], [61], [62], [63], [65]];
        $targets = [3.1, 3.6, 3.8, 4, 4.1];
        $regression = new SVR(Kernel::LINEAR);
        $regression->train($samples, $targets);
        $r = $regression->predict([64]);
        var_dump($r);
        */

        /*
        $samples = [[3.1], [3.2], [3.3], [3.5], [3.6]];
        $targets = [1, 2, 3, 5, 6];
        $regression = new LeastSquares();
        $regression->train($samples, $targets);
        $r = $regression->predict([3.4]);
        var_dump($r);
        */

        /*
        $samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];
        $kmeans = new KMeans(2);
        $r = $kmeans->cluster($samples);
        var_dump($r);
        */
        
        /*
        $samples = [[1, 1], [8, 7], [1, 2], [7, 8], [2, 1], [8, 9]];
        $dbscan = new DBSCAN($epsilon = 2, $minSamples = 3);
        $r = $dbscan->cluster($samples);
        var_dump($r); die();
        */

        //比较两个数组的相似度
        /*
        $actualLabels = ['a', 'b', 'a', 'b'];
        $predictedLabels = ['a', 'a', 'a', 'b'];
        $r1 = Accuracy::score($actualLabels, $predictedLabels);
        var_dump($r1);
        $r2 = Accuracy::score($actualLabels, $predictedLabels, false);
        var_dump($r2); die();
        */

        /*
        $actualTargets = [2, 0, 2, 2, 0, 1];
        $predictedTargets = [0, 0, 2, 2, 0, 2];
        $confusionMatrix = ConfusionMatrix::compute($actualTargets, $predictedTargets);
        var_dump($confusionMatrix);

        $actualTargets = ['cat', 'ant', 'cat', 'cat', 'ant', 'bird'];
        $predictedTargets = ['ant', 'ant', 'cat', 'cat', 'ant', 'cat'];
        $confusionMatrix = ConfusionMatrix::compute($actualTargets, $predictedTargets, ['ant', 'bird']);
        var_dump($confusionMatrix); die();
        */

        /*
        $actualLabels = ['cat', 'ant', 'bird', 'bird', 'bird'];
        $predictedLabels = ['cat', 'cat', 'bird', 'bird', 'ant'];
        $report = new ClassificationReport($actualLabels, $predictedLabels);
        $r1 = $report->getPrecision();
        var_dump($r1);
        $r2 = $report->getRecall();
        var_dump($r2);
        $r3 = $report->getF1score();
        var_dump($r3);
        $r4 = $report->getSupport();
        var_dump($r4);
        $r5 = $report->getAverage();
        var_dump($r5);
        die();
        */

        /*
        $transformers = [
            new Imputer(null, new MostFrequentStrategy()),
            new Normalizer(),
        ];
        $estimator = new SVC();
        $samples = [
            [1, -1, 2],
            [2, 0, null],
            [null, 1, -1],
        ];
        $targets = [
            4,
            1,
            4,
        ];
        $pipeline = new Pipeline($transformers, $estimator);
        $pipeline->train($samples, $targets);
        $predicted = $pipeline->predict([[0, 0, 0]]);
        var_dump($predicted); die();
        */

        /*
        $samples = [
            [1, -1, 2],
            [2, 0, 0],
            [0, 1, -1],
        ];
        $normalizer = new Normalizer();
        $r1 = $normalizer->preprocess($samples);
        var_dump($r1);

        $samples = [
            [1, -1, 2],
            [2, 0, 0],
            [0, 1, -1],
        ];
        $normalizer = new Normalizer(Normalizer::NORM_L1);
        $r2 = $normalizer->preprocess($samples);
        var_dump($r2);
        */

        $samples = [['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta'], ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta']];
        $labels  = [];
        $associator = new Apriori($support = 0.5, $confidence = 0.5);
        $associator->train($samples, $labels);
        $r1 = $associator->predict(['alpha','theta']);
        $r2 = $associator->predict([['alpha','epsilon'],['beta','theta']]);
        $r3 = $associator->getRules();
        $r4 = $associator->apriori();
        var_dump($r1, $r2, $r4);

    }
}
